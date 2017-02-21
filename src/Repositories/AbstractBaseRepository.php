<?php namespace WebEd\Base\Core\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use WebEd\Base\Core\Criterias\AbstractCriteria;
use WebEd\Base\Core\Criterias\Contracts\CriteriaContract;
use WebEd\Base\Core\Exceptions\Repositories\WrongCriteria;
use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Repositories\Contracts\AbstractRepositoryContract;
use WebEd\Base\Core\Repositories\Contracts\RepositoryValidatorContract;
use WebEd\Base\Core\Repositories\Traits\RepositoryValidatable;

abstract class AbstractBaseRepository implements AbstractRepositoryContract, RepositoryValidatorContract
{
    use RepositoryValidatable;

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
        $this->cacheEnabled = config('webed-caching.repository.enabled');
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
    public function pushCriteria(CriteriaContract $criteria)
    {
        if (!$criteria instanceof CriteriaContract) {
            throw new WrongCriteria('Class ' . get_class($criteria) . ' must be an instance of ' . CriteriaContract::class);
        }
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
            foreach ($criteria as $className => $c) {
                $this->model = $c->apply($this->model, $this);
            }
        }

        return $this;
    }

    /**
     * @param AbstractCriteria|string $criteria
     * @return Collection|BaseModelContract|LengthAwarePaginator|null|mixed
     */
    public function getByCriteria(CriteriaContract $criteria)
    {
        if (is_string($criteria)) {
            $criteria = app($criteria);
        }
        if (!$criteria instanceof CriteriaContract) {
            throw new WrongCriteria('Class ' . get_class($criteria) . ' must be an instance of ' . CriteriaContract::class);
        }

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
}
