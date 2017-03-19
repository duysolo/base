<?php namespace WebEd\Base\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Models\EloquentBase;
use WebEd\Base\Repositories\AbstractBaseRepository;

/**
 * @property BaseModelContract|EloquentBase|Builder $model
 * @property BaseModelContract|EloquentBase|Builder $originalModel
 */
abstract class EloquentBaseRepository extends AbstractBaseRepository
{
    /**
     * @param $id
     * @param array $columns
     * @return EloquentBase|null
     */
    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $result = $this->model->find($id, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $condition
     * @return EloquentBase|null|mixed
     */
    public function findWhere(array $condition)
    {
        $result = $this->model->where($condition)->first();
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $condition
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return EloquentBase|null
     */
    public function findWhereOrCreate(array $condition, array $optionalFields = [], $forceCreate = false)
    {
        $this->model = $this->model->where($condition);

        $result = $this->model->first();
        if (!$result) {
            $data = array_merge((array)$optionalFields, $condition);
            if ($forceCreate) {
                $this->forceCreate($data);
            } else {
                $this->create($data);
            }
            $this->model = $this->model->where($condition);
            $result = $this->model->first();
        }
        return $result;
    }

    /**
     * @return int
     */
    public function count()
    {
        $this->applyCriteria();
        $result = $this->model->count();
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function get(array $columns = ['*'])
    {
        $this->applyCriteria();
        $result = $this->model->get($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $condition
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWhere(array $condition, array $columns = ['*'])
    {
        $this->applyCriteria();
        $result = $this->model
            ->where($condition)
            ->get($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first(array $columns = ['*'])
    {
        $this->applyCriteria();
        $result = $this->model->first($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $perPage
     * @param array $columns
     * @param int $currentPaged
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, array $columns = ['*'], $currentPaged = 1)
    {
        $this->applyCriteria();
        $result = $this->model->paginate($perPage, $columns, 'page', $currentPaged);
        $this->resetModel();
        return $result;
    }

    /**
     * Create a new item.
     * Only fields listed in $fillable of model can be filled
     * @param array $data
     * @return EloquentBase
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Create a new item, no validate
     * @param $data
     * @return EloquentBase
     */
    public function forceCreate(array $data)
    {
        return $this->model->forceCreate($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrNew($id)
    {
        return $this->model->find($id) ?: new $this->model;
    }

    /**
     * Validate model then edit
     * @param BaseModelContract|int|null $id
     * @param $data
     * @param bool $allowCreateNew
     * @param bool $justUpdateSomeFields
     * @return array
     */
    public function editWithValidate($id, array $data, $allowCreateNew = false, $justUpdateSomeFields = false)
    {
        if ($id instanceof EloquentBase) {
            $item = $id;
        } else {
            if ($allowCreateNew != true) {
                $item = $this->find($id);
                if (!$item) {
                    return response_with_messages(trans('webed-core::base.form.model_not_exists') . ' ' . $id, true, \Constants::NOT_FOUND_CODE);
                }
            } else {
                $item = $this->findOrNew($id);
            }
        }

        /**
         * Unset some data that not changed
         */
        if ($item->{$item->getPrimaryKey()}) {
            $this->unsetNotChangedData($item, $data);
        }

        /**
         * Unset not editable fields
         */
        $this->unsetNotEditableFields($data);

        /**
         * Nothing to update
         */
        if (!$data) {
            return response_with_messages(trans('webed-core::base.form.request_completed'), false, \Constants::SUCCESS_NO_CONTENT_CODE, $item);
        }

        /**
         * Validate model
         */
        $validate = $this->validateModel($data, $justUpdateSomeFields);

        /**
         * Do not passed validate
         */
        if (!$validate) {
            return response_with_messages($this->getRuleErrorMessages(), true, \Constants::ERROR_CODE);
        }

        $primaryKey = $this->getPrimaryKey();

        /**
         * Prevent edit the primary key
         */
        if (isset($data[$primaryKey])) {
            unset($data[$primaryKey]);
        }

        foreach ($data as $key => $row) {
            $item->$key = $row;
        }

        try {
            $item->save();
        } catch (\Exception $exception) {
            $this->resetModel();
            return response_with_messages($exception->getMessage(), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(trans('webed-core::base.form.request_completed'), false, \Constants::SUCCESS_CODE, $item);
    }

    /**
     * Find items by ids and edit them
     * @param array $ids
     * @param array $data
     * @param bool $justUpdateSomeFields
     * @return array
     */
    public function updateMultiple(array $ids, array $data, $justUpdateSomeFields = false)
    {
        /**
         * Unset not editable fields
         */
        $this->unsetNotEditableFields($data);

        $validate = $this->validateModel($data, $justUpdateSomeFields);
        if (!$validate) {
            return response_with_messages($this->getRuleErrorMessages(), true, \Constants::ERROR_CODE);
        }

        $items = $this->model->whereIn('id', $ids);

        try {
            $items->update($data);
        } catch (\Exception $exception) {
            $this->resetModel();
            return response_with_messages($exception->getMessage(), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(trans('webed-core::base.form.request_completed'), false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }

    /**
     * Find items by fields and edit them
     * @param array $fields
     * @param $data
     * @param bool $justUpdateSomeFields
     * @return array
     */
    public function update(array $data, $justUpdateSomeFields = false)
    {
        /**
         * Unset not editable fields
         */
        $this->unsetNotEditableFields($data);

        $validate = $this->validateModel($data, $justUpdateSomeFields);
        if (!$validate) {
            return response_with_messages($this->getRuleErrorMessages(), true, \Constants::ERROR_CODE);
        }

        $this->applyCriteria();

        try {
            $this->model->update($data);
        } catch (\Exception $exception) {
            $this->resetModel();
            return response_with_messages($exception->getMessage(), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(trans('webed-core::base.form.request_completed'), false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }

    /**
     * Delete items by id
     * @param EloquentBase|int|array $id
     * @return mixed
     */
    public function delete($id)
    {
        if ($id) {
            if (is_array($id)) {
                $this->model = $this->model->whereIn('id', $id);
            } elseif ($id instanceof EloquentBase) {
                $this->model = $id;
            } else {
                $this->model = $this->model->where('id', '=', $id);
            }
        } else {
            $this->applyCriteria();
        }

        try {
            $this->model->delete();
        } catch (\Exception $exception) {
            $this->resetModel();
            return response_with_messages($exception->getMessage(), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(trans('webed-core::base.form.request_completed'), false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }
}
