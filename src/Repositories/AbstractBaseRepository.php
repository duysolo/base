<?php namespace WebEd\Base\Core\Repositories;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;

use WebEd\Base\Core\Repositories\Contracts\QueryBuilderContract;
use WebEd\Base\Core\Repositories\Traits\BaseMethods as BaseMethods;

use WebEd\Base\Core\Repositories\Contracts\ModelNeedValidateContract;
use WebEd\Base\Core\Repositories\Contracts\BaseMethodsContract;

use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Core\Repositories\Traits\ModelNeedValidate;
use WebEd\Base\Core\Repositories\Traits\QueryBuilder;

abstract class AbstractBaseRepository implements ModelNeedValidateContract, BaseMethodsContract, QueryBuilderContract
{
    use ModelNeedValidate;

    use BaseMethods;

    use QueryBuilder;

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
}
