<?php namespace WebEd\Base\Repositories\Contracts;

use WebEd\Base\Criterias\AbstractCriteria;
use WebEd\Base\Models\Contracts\BaseModelContract;
use Illuminate\Support\Collection;
use WebEd\Base\Exceptions\Repositories\WrongCriteria;
use WebEd\Base\Criterias\Contracts\CriteriaContract;
use Illuminate\Pagination\LengthAwarePaginator;

interface AbstractRepositoryContract
{
    /**
     * @return BaseModelContract
     */
    public function getModel();

    /**
     * Get model table
     * @return string
     */
    public function getTable();

    /**
     * Get primary key
     * @return string
     */
    public function getPrimaryKey();

    /**
     * @return Collection
     */
    public function getCriteria();

    /**
     * @param AbstractCriteria $criteria
     * @return $this
     * @throws WrongCriteria
     */
    public function pushCriteria(AbstractCriteria $criteria);

    /**
     * @param AbstractCriteria|string $criteria
     * @return $this
     */
    public function dropCriteria($criteria);

    /**
     * @param bool $bool
     * @return $this
     */
    public function skipCriteria($bool = true);

    /**
     * @return $this
     */
    public function applyCriteria();

    /**
     * @param AbstractCriteria $criteria
     * @param array $constructorArgs
     * @return Collection|BaseModelContract|LengthAwarePaginator|null|mixed
     */
    public function getByCriteria(AbstractCriteria $criteria);

    /**
     * @return $this
     */
    public function resetModel();

    /**
     * @return int
     */
    public function count();

    /**
     * @param array $columns
     * @return mixed
     */
    public function first(array $columns = ['*']);

    /**
     * @param int $id
     * @param array $columns
     * @return BaseModelContract|null
     */
    public function find($id, $columns = ['*']);

    /**
     * @param array $condition
     * @param array $columns
     * @return BaseModelContract|null|mixed
     */
    public function findWhere(array $condition, array $columns = ['*']);

    /**
     * @param array $condition
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return BaseModelContract|null
     */
    public function findWhereOrCreate(array $condition, array $optionalFields = [], $forceCreate = false);

    /**
     * @param int $id
     * @return BaseModelContract
     */
    public function findOrNew($id);

    /**
     * @param array $condition
     * @return BaseModelContract
     */
    public function firstOrNew(array $condition);

    /**
     * @param array $columns
     * @return Collection
     */
    public function get(array $columns = ['*']);

    /**
     * @param array $condition
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getWhere(array $condition, array $columns = ['*']);

    /**
     * @param int $perPage
     * @param array $columns
     * @param int $currentPaged
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage, array $columns = ['*'], $currentPaged = 1);

    /**
     * @param array $data
     * @param bool $force
     * @return int|null|BaseModelContract
     */
    public function create(array $data, $force = false);

    /**
     * @param BaseModelContract|int|null $id
     * @param array $data
     * @return int|null|BaseModelContract
     */
    public function createOrUpdate($id, array $data);

    /**
     * @param BaseModelContract|int $id
     * @param array $data
     * @return int|null|BaseModelContract
     */
    public function update($id, array $data);

    /**
     * @param array $ids
     * @param array $data
     * @return bool
     */
    public function updateMultiple(array $ids, array $data);

    /**
     * @param BaseModelContract|int|array|null $id
     * @param bool $force
     * @return mixed
     */
    public function delete($id, $force = false);

    /**
     * @param array $condition
     * @param bool $force
     * @return bool
     */
    public function deleteWhere(array $condition, $force = false);

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Collection|mixed|null
     */
    public function advancedGet(array $params = []);
}
