<?php namespace WebEd\Base\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use WebEd\Base\Criterias\AbstractCriteria;
use WebEd\Base\Criterias\Contracts\CriteriaContract;
use WebEd\Base\Exceptions\Repositories\WrongCriteria;
use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;
use WebEd\Base\Repositories\Contracts\RepositoryValidatorContract;
use WebEd\Base\Repositories\Traits\RepositoryValidatable;

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

    /**
     * Determine when enabled cache for query
     * @var bool
     */
    protected $cacheEnabled;

    public function __construct(BaseModelContract $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
        $this->cacheEnabled = (bool)config('webed-caching.repository.enabled');
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
        $this->cacheEnabled = config('webed-caching.repository.enabled');
        return $this;
    }

    /**
     * @param $id
     * @param array $columns
     * @return BaseModelContract|null
     */
    abstract public function find($id, $columns = ['*']);

    /**
     * @param array $condition
     * @return BaseModelContract|null|mixed
     */
    abstract public function findWhere(array $condition);

    /**
     * @param $id
     * @return mixed
     */
    abstract public function findOrNew($id);

    /**
     * @param array $condition
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return BaseModelContract|null
     */
    abstract public function findWhereOrCreate(array $condition, array $optionalFields = [], $forceCreate = false);

    /**
     * @return int
     */
    abstract public function count();

    /**
     * @param array $columns
     * @return Collection
     */
    abstract public function get(array $columns = ['*']);

    /**
     * @param array $condition
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    abstract public function getWhere(array $condition, array $columns = ['*']);

    /**
     * @param array $columns
     * @return mixed
     */
    abstract public function first(array $columns = ['*']);

    /**
     * @param $perPage
     * @param array $columns
     * @param int $currentPaged
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    abstract public function paginate($perPage, array $columns = ['*'], $currentPaged = 1);

    /**
     * Create a new item.
     * Only fields listed in $fillable of model can be filled
     * @param array $data
     * @return BaseModelContract
     */
    abstract public function create(array $data);

    /**
     * Create a new item, no validate
     * @param $data
     * @return BaseModelContract
     */
    abstract public function forceCreate(array $data);

    /**
     * Validate model then edit
     * @param BaseModelContract|int|null $id
     * @param $data
     * @param bool $allowCreateNew
     * @param bool $justUpdateSomeFields
     * @return array
     */
    abstract public function editWithValidate($id, array $data, $allowCreateNew = false, $justUpdateSomeFields = false);

    /**
     * Find items by ids and edit them
     * @param array $ids
     * @param array $data
     * @param bool $justUpdateSomeFields
     * @return array
     */
    abstract public function updateMultiple(array $ids, array $data, $justUpdateSomeFields = false);

    /**
     * Find items by fields and edit them
     * @param array $fields
     * @param $data
     * @param bool $justUpdateSomeFields
     * @return array
     */
    abstract public function update(array $data, $justUpdateSomeFields = false);

    /**
     * Delete items by id
     * @param BaseModelContract|int|array $id
     * @return mixed
     */
    abstract public function delete($id);
}
