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
     * @param $id
     * @param array $columns
     * @return EloquentBase|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $condition
     * @return EloquentBase|null|mixed
     */
    public function findWhere(array $condition)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $condition
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return EloquentBase|null
     */
    public function findWhereOrCreate(array $condition, array $optionalFields = [], $forceCreate = false)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * @return int
     */
    public function count()
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
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getWhere(array $condition, array $columns = ['*'])
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
     * @param $perPage
     * @param array $columns
     * @param int $currentPaged
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, array $columns = ['*'], $currentPaged = 1)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
    }

    /**
     * Create a new item.
     * Only fields listed in $fillable of model can be filled
     * @param array $data
     * @return EloquentBase
     */
    public function create(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * Create a new item, no validate
     * @param $data
     * @return EloquentBase
     */
    public function forceCreate(array $data)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrNew($id)
    {
        return $this->beforeGet(__FUNCTION__, func_get_args());
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
        return $this->afterUpdate(__FUNCTION__, func_get_args());
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
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }

    /**
     * Delete items by id
     * @param EloquentBase|int|array $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
