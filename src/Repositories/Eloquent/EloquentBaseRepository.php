<?php namespace WebEd\Base\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
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
     * @param array $where
     */
    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                list($field, $condition, $val) = $value;
                if (strtoupper($condition) == 'IN') {
                    $this->model = $this->model->whereIn($field, $val);
                } else {
                    $this->model = $this->model->where($field, $condition, $val);
                }
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
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
     * @param int $id
     * @param array $columns
     * @return EloquentBase|Builder|null
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
     * @return EloquentBase|Builder|null|mixed
     */
    public function findWhere(array $condition)
    {
        $this->applyConditions($condition);
        $result = $this->model->first();

        $this->resetModel();

        return $result;
    }

    /**
     * @param array $condition
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return EloquentBase|Builder|null
     */
    public function findWhereOrCreate(array $condition, array $optionalFields = [], $forceCreate = false)
    {
        $result = $this->findWhere($condition);
        if (!$result) {
            $data = array_merge((array)$optionalFields, $condition);
            $id = $this->create($data);
            $result = $this->find($id);
        }
        $this->resetModel();
        return $result;
    }

    /**
     * @param int $id
     * @return EloquentBase|Builder
     */
    public function findOrNew($id)
    {
        return $this->model->find($id) ?: new $this->model;
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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhere(array $condition, array $columns = ['*'])
    {
        $this->applyCriteria();

        $this->applyConditions($condition);

        $result = $this->model->get($columns);

        $this->resetModel();

        return $result;
    }

    /**
     * @param int $perPage
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
     * @param array $data
     * @param bool $force
     * @return int|null
     */
    public function create(array $data, $force = false)
    {
        $method = $force ? 'forceCreate' : 'create';
        try {
            $item = $this->model->$method($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $this->resetModel();
            return null;
        }
        $primaryKey = $this->getPrimaryKey();
        return $item->$primaryKey;
    }

    /**
     * @param EloquentBase|Builder|int|null $id
     * @param array $data
     * @return int|null
     */
    public function createOrUpdate($id, array $data)
    {
        /**
         * @var EloquentBase|Builder $item
         */
        $item = $id instanceof EloquentBase ? $id : $this->model->find($id) ?: new $this->model;

        $item = $item->fill($data);

        try {
            $item->save();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $this->resetModel();
            return null;
        }
        $this->resetModel();
        $primaryKey = $this->getPrimaryKey();
        return $item->$primaryKey;
    }

    /**
     * @param EloquentBase|Builder|int $id
     * @param array $data
     * @return int|null
     */
    public function update($id, array $data)
    {
        if ($id instanceof EloquentBase) {
            $item = $id;
        } else {
            $item = $this->model->find($id);
        }

        try {
            $item->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $this->resetModel();
            dd($exception->getMessage());
            return null;
        }
        $this->resetModel();
        $primaryKey = $this->getPrimaryKey();
        return $item->$primaryKey;
    }

    /**
     * @param array $ids
     * @param array $data
     * @return bool
     */
    public function updateMultiple(array $ids, array $data)
    {
        $items = $this->model->whereIn('id', $ids);

        try {
            $items->update($data);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $this->resetModel();
            return false;
        }
        $this->resetModel();
        return true;
    }

    /**
     * @param EloquentBase|Builder|int|array|null $id
     * @param bool $force
     * @return bool
     */
    public function delete($id, $force = false)
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

        $method = $force ? 'forceDelete' : 'delete';

        try {
            $this->model->$method();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $this->resetModel();
            return false;
        }
        $this->resetModel();
        return true;
    }
}
