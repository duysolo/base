<?php namespace WebEd\Base\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use WebEd\Base\Repositories\AbstractRepositoryCacheDecorator;
use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Models\EloquentBase;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use WebEd\Base\Menu\Models\MenuNode;

/**
 * @property EloquentBaseRepository|Cacheable $repository
 */
abstract class EloquentBaseRepositoryCacheDecorator extends AbstractRepositoryCacheDecorator
{
    /**
     * @return int
     */
    public function count()
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function first(array $columns = ['*'])
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param int $id
     * @param array $columns
     * @return EloquentBase|Builder|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $condition
     * @return EloquentBase|Builder|null|mixed
     */
    public function findWhere(array $condition)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $condition
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return EloquentBase|Builder|null
     */
    public function findWhereOrCreate(array $condition, array $optionalFields = [], $forceCreate = false)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param int $id
     * @return EloquentBase|Builder
     */
    public function findOrNew($id)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function get(array $columns = ['*'])
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $condition
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhere(array $condition, array $columns = ['*'])
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @param int $currentPaged
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, array $columns = ['*'], $currentPaged = 1)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $data
     * @return int
     */
    public function create(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $data
     * @return int
     */
    public function forceCreate(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param EloquentBase|Builder|int|null $id
     * @param array $data
     * @return int|null
     */
    public function createOrUpdate($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param EloquentBase|Builder|int $id
     * @param array $data
     * @return int|null
     */
    public function update($id, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $ids
     * @param array $data
     * @return bool
     */
    public function updateMultiple(array $ids, array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param EloquentBase|Builder|int|array|null $id
     * @param bool $force
     * @return bool
     */
    public function delete($id, $force = false)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
