<?php namespace WebEd\Base\Core\Repositories\Contracts;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use Illuminate\Support\Collection;
use WebEd\Base\Core\Exceptions\Repositories\WrongCriteria;
use WebEd\Base\Core\Criterias\Contracts\CriteriaContract;
use Illuminate\Pagination\LengthAwarePaginator;

interface AbstractRepositoryContract
{
    /**
     * @return BaseModelContract
     */
    public function getModel();

    /**
     * @return BaseModelContract
     */
    public function getBuilderModel();

    /**
     * @return array
     */
    public function getBuilder();

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
     * @param $columns
     * @return $this
     */
    public function select($columns);

    /**
     * @return Collection
     */
    public function getCriteria();

    /**
     * @param $criteria
     * @return $this
     * @throws WrongCriteria
     */
    public function pushCriteria($criteria);

    /**
     * @param $criteria
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
     * @param CriteriaContract|string $criteria
     * @return Collection|BaseModelContract|LengthAwarePaginator|null|mixed
     */
    public function getByCriteria($criteria, array $crossData = []);

    /**
     * @return $this
     */
    public function resetModel();

    /**
     * @return $this
     */
    public function resetBuilder();
}
