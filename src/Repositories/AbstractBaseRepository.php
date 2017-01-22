<?php namespace WebEd\Base\Core\Repositories;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;

use WebEd\Base\Core\Repositories\Contracts\QueryBuilderContract;
use WebEd\Base\Core\Repositories\Contracts\WithViewTrackerContract;
use WebEd\Base\Core\Repositories\Traits\BaseMethods as BaseMethods;

use WebEd\Base\Core\Repositories\Contracts\ModelNeedValidateContract;
use WebEd\Base\Core\Repositories\Contracts\BaseMethodsContract;

use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Core\Repositories\Traits\ModelNeedValidate;
use WebEd\Base\Core\Repositories\Traits\QueryBuilder;
use WebEd\Base\Core\Repositories\Traits\WithViewTracker;

abstract class AbstractBaseRepository implements ModelNeedValidateContract, BaseMethodsContract, QueryBuilderContract, WithViewTrackerContract
{
    use ModelNeedValidate;

    use BaseMethods;

    use QueryBuilder;

    use WithViewTracker;

    use Cacheable;

    /**
     * @var \WebEd\Base\Core\Models\EloquentBase
     */
    protected $model;

    /**
     * @var \WebEd\Base\Core\Models\EloquentBase
     */
    protected $originalModel;

    public function __construct(BaseModelContract $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }

    /**
     * @return \WebEd\Base\Core\Models\EloquentBase
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
        return $this->model->getTable();
    }

    /**
     * Get primary key
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->model->getPrimaryKey();
    }

    /**
     * @param string|array $messages
     * @param bool $error
     * @param int $responseCode
     * @param array $data
     * @return array
     */
    public function setMessages($messages, $error = false, $responseCode = null, $data = null)
    {
        return response_with_messages($messages, $error, $responseCode ?: \Constants::SUCCESS_NO_CONTENT_CODE, $data);
    }

    /**
     * @param BaseModelContract $model
     * @return $this
     */
    public function pushModel(BaseModelContract $model)
    {
        /**
         * Must are the same instance
         */
        if (get_class($model) === get_class($this->model)) {
            $this->model = $model;
        }

        return $this;
    }

    /**
     * @param $class
     * @param $method
     * @return $this
     */
    public function pushCriteria($class, $method)
    {
        $instance = is_object($class) ? $class : app($class);
        $this->model = call_user_func_array([$instance, $method], [$this->model]);

        $this->criterias[] = get_class($instance) . '@' . $method;

        return $this;
    }

    /**
     * @param $class
     * @param $method
     * @param array $args
     * @return mixed
     */
    public function getByCriteria($class, $method, array $args)
    {
        $instance = app($class);
        return call_user_func_array([$instance, $method], $args);
    }
}
