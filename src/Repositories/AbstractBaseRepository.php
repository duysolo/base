<?php namespace WebEd\Base\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use WebEd\Base\Criterias\AbstractCriteria;
use WebEd\Base\Exceptions\Repositories\WrongCriteria;
use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;

abstract class AbstractBaseRepository implements AbstractRepositoryContract
{
    /**
     * @var BaseModelContract
     */
    protected $model;

    /**
     * @var BaseModelContract
     */
    protected $originalModel;

    /**
     * @var array
     */
    protected $criteria = [];

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    public function __construct(BaseModelContract $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }

    /**
     * @return BaseModelContract
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get model table
     * @return string
     */
    public function getTable()
    {
        return $this->originalModel->getTable();
    }

    /**
     * Get primary key
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->originalModel->getPrimaryKey();
    }

    /**
     * @return array
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param AbstractCriteria $criteria
     * @param array $crossData
     * @return $this
     * @throws WrongCriteria
     */
    public function pushCriteria(AbstractCriteria $criteria)
    {
        $this->criteria[get_class($criteria)] = $criteria;
        return $this;
    }

    /**
     * @param AbstractCriteria|string $criteria
     * @return $this
     */
    public function dropCriteria($criteria)
    {
        $className = $criteria;
        if (is_object($className)) {
            $className = get_class($criteria);
        }

        if (isset($this->criteria[$className])) {
            unset($this->criteria[$className]);
        }
        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function skipCriteria($bool = true)
    {
        $this->skipCriteria = $bool;
        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }

        $criteria = $this->getCriteria();

        if ($criteria) {
            foreach ($criteria as $className => $criterion) {
                $this->model = $criterion->apply($this->model, $this);
            }
        }

        return $this;
    }

    /**
     * @param AbstractCriteria|string $criteria
     * @return Collection|BaseModelContract|LengthAwarePaginator|null|mixed
     */
    public function getByCriteria(AbstractCriteria $criteria)
    {
        return $criteria->apply($this->originalModel, $this);
    }

    /**
     * @return $this
     */
    public function resetModel()
    {
        $this->model = $this->originalModel;
        $this->skipCriteria = false;
        $this->criteria = [];

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function expandFillable(array $attributes)
    {
        $this->model = $this->model->expandFillable($attributes);

        return $this;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function unsetFillable(array $attributes)
    {
        $this->model = $this->model->unsetFillable($attributes);

        return $this;
    }
}
