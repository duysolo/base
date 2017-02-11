<?php namespace WebEd\Base\Core\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
     * @var BaseModelContract
     */
    protected $builderModel;

    /**
     * @var array
     */
    protected $criteria = [];

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * @var int
     */
    protected $currentPaged;

    /**
     * @var array
     */
    protected $select = [];

    protected $builder = [];

    public function __construct(BaseModelContract $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
        $this->builderModel = $model;
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
     * @return BaseModelContract
     */
    public function getBuilderModel()
    {
        return $this->builderModel;
    }

    /**
     * @return array
     */
    public function getBuilder()
    {
        return $this->builder;
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
     * @param $columns
     * @return $this
     */
    public function select($columns)
    {
        if (!is_array($columns)) {
            $this->select = func_get_args();
        } else {
            $this->select = $columns;
        }
        $this->builder['select'] = func_get_args();
        return $this;
    }

    /**
     * @return array
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param $criteria
     * @param array $crossData
     * @return $this
     * @throws WrongCriteria
     */
    public function pushCriteria($criteria, array $crossData = [])
    {
        if (is_string($criteria)) {
            $criteria = app($criteria);
        }
        if (!$criteria instanceof CriteriaContract) {
            throw new WrongCriteria('Class ' . get_class($criteria) . ' must be an instance of ' . CriteriaContract::class);
        }
        $this->criteria[get_class($criteria)] = [$criteria, $crossData];
        return $this;
    }

    /**
     * @param $criteria
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
                if ($c[0] instanceof CriteriaContract) {
                    $this->model = $c[0]->apply($this->model, $this, $c[1]);
                    $this->builder['criteria'][$className] = [$className, $c[1]];
                }
            }
        }
        if ($this->select) {
            $this->model = $this->model->select($this->select);
        }

        $this->builderModel = $this->model;

        return $this;
    }

    /**
     * @param CriteriaContract|string $criteria
     * @return Collection|BaseModelContract|LengthAwarePaginator|null|mixed
     */
    public function getByCriteria($criteria, array $crossData = [])
    {
        if (is_string($criteria)) {
            $criteria = app($criteria);
        }
        if (!$criteria instanceof CriteriaContract) {
            throw new WrongCriteria('Class ' . get_class($criteria) . ' must be an instance of ' . CriteriaContract::class);
        }

        return $criteria->apply($this->originalModel, $this, $crossData);
    }

    /**
     * @return $this
     */
    public function resetModel()
    {
        $this->model = $this->originalModel;
        $this->skipCriteria = false;
        $this->criteria = [];
        $this->select = [];
        return $this;
    }

    /**
     * @return $this
     */
    public function resetBuilder()
    {
        $this->builder = [];
        $this->builderModel = $this->originalModel;
        return $this;
    }
}
