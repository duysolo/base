<?php namespace WebEd\Base\Core\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Models\EloquentBase;
use WebEd\Base\Core\Repositories\AbstractBaseRepository;

/**
 * @property EloquentBase|Builder $model
 * @property EloquentBase|Builder $originalModel
 */
abstract class EloquentBaseRepository extends AbstractBaseRepository
{
    /**
     * @param $field
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function where($field, $operator = null, $value = null)
    {
        if (is_array($field)) {
            $this->model = $this->model->where($field);
        } else {
            if (sizeof(func_get_args()) == 2) {
                $this->model = $this->model->where($field, '=', $operator);
            } else {
                $this->model = $this->model->where($field, $operator, $value);
            }
        }
        $this->builderModel = $this->model;
        $this->builder['where'][] = func_get_args();

        return $this;
    }

    /**
     * @param $field
     * @param null $type
     * @return $this
     */
    public function orderBy($field, $type = null)
    {
        if (is_array($field)) {
            foreach ($field as $key => $row) {
                $this->model = $this->model->orderBy($key, $row);
            }
        } else {
            $this->model = $this->model->orderBy($field, $type);
        }
        $this->builderModel = $this->model;
        $this->builder['orderBy'][] = func_get_args();

        return $this;
    }

    /**
     * @param $id
     * @param array $columns
     * @return EloquentBase|null
     */
    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->builderModel = $this->model;
        $result = $this->model->find($id, $columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @return mixed
     */
    public function count()
    {
        $this->applyCriteria();
        $this->builderModel = $this->model;
        $result = $this->model->count();
        $this->resetModel();
        return $result;
    }

    /**
     * @param $howManyItem
     * @return $this
     */
    public function take($howManyItem)
    {
        $this->model = $this->model->take($howManyItem);
        $this->builderModel = $this->model;
        $this->builder['take'] = func_get_args();

        return $this;
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function get($columns = ['*'])
    {
        if (!is_array($columns)) {
            $columns = func_get_args();
        }

        $this->applyCriteria();
        $this->builderModel = $this->model;
        $result = $this->model->get($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first($columns = ['*'])
    {
        $this->applyCriteria();
        $this->builderModel = $this->model;
        $result = $this->model->first($columns);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $currentPaged
     * @return LengthAwarePaginator
     */
    public function paginate($perPage, $columns = ['*'], $pageName = 'page', $currentPaged = null)
    {
        $this->applyCriteria();
        $this->builderModel = $this->model;
        $result = $this->model->paginate($perPage, $columns, $pageName, $currentPaged);
        $this->resetModel();
        return $result;
    }

    /**
     * @param $fields
     * @return EloquentBase|null
     */
    public function findByFields($fields)
    {
        return $this->model->where($fields)->first();
    }

    /**
     * @param $fields
     * @param null $optionalFields
     * @param bool $forceCreate
     * @return EloquentBase|null
     */
    public function findByFieldsOrCreate($fields, $optionalFields = null, $forceCreate = false)
    {
        $result = $this->model->where($fields)->first();
        if (!$result) {
            $data = array_merge((array)$optionalFields, $fields);
            if ($forceCreate) {
                $this->model->forceCreate($data);
            } else {
                $this->model->create($data);
            }
            $result = $this->model->where($fields)->first();
        }
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
                    return response_with_messages(['Model not exists with id: ' . $id], true, \Constants::NOT_FOUND_CODE);
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
        $cannotEdit = collect($this->unsetNotEditableFields($data));
        if ($cannotEdit->count()) {
            $cannotEdit = ['Cannot edit these fields: ' . $cannotEdit->implode(', ')];
        } else {
            $cannotEdit = [];
        }

        /**
         * Nothing to update
         */
        if (!$data) {
            return response_with_messages(array_merge(['Request completed'], $cannotEdit), false, \Constants::SUCCESS_NO_CONTENT_CODE, $item);
        }

        /**
         * Validate model
         */
        $validate = $this->validateModel($data, $justUpdateSomeFields);

        /**
         * Do not passed validate
         */
        if (!$validate) {
            return response_with_messages(array_merge($this->getRuleErrorMessages(), $cannotEdit), true, \Constants::ERROR_CODE);
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
            return response_with_messages(array_merge([$exception->getMessage()], $cannotEdit), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(array_merge(['Request completed'], $cannotEdit), false, \Constants::SUCCESS_CODE, $item);
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
        $cannotEdit = collect($this->unsetNotEditableFields($data));
        if ($cannotEdit->count()) {
            $cannotEdit = ['Cannot update these fields' . $cannotEdit->implode(', ')];
        } else {
            $cannotEdit = [];
        }

        $validate = $this->validateModel($data, $justUpdateSomeFields);
        if (!$validate) {
            return response_with_messages(array_merge($this->getRuleErrorMessages(), $cannotEdit), true, \Constants::ERROR_CODE);
        }

        $items = $this->model->whereIn('id', $ids);

        try {
            $items->update($data);
        } catch (\Exception $exception) {
            $this->resetModel();
            return response_with_messages(array_merge([$exception->getMessage()], $cannotEdit), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(array_merge(['Request completed'], $cannotEdit), false, \Constants::SUCCESS_NO_CONTENT_CODE);
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
        $cannotEdit = collect($this->unsetNotEditableFields($data));
        if ($cannotEdit->count()) {
            $cannotEdit = ['Cannot update these fields' . $cannotEdit->implode(', ')];
        } else {
            $cannotEdit = [];
        }

        $validate = $this->validateModel($data, $justUpdateSomeFields);
        if (!$validate) {
            return response_with_messages(array_merge($this->getRuleErrorMessages(), $cannotEdit), true, \Constants::ERROR_CODE);
        }

        $this->applyCriteria();

        try {
            $this->model->update($data);
        } catch (\Exception $exception) {
            $this->resetModel();
            return response_with_messages(array_merge([$exception->getMessage()], $cannotEdit), true, \Constants::ERROR_CODE);
        }
        $this->resetModel();
        return response_with_messages(array_merge(['Request completed'], $cannotEdit), false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }

    /**
     * Delete items by id
     * @param EloquentBase|int|array|null $id
     * @return mixed
     */
    public function delete($id = null)
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
        return response_with_messages('Request completed', false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }
}
