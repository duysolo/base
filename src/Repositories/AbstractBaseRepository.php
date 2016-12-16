<?php namespace WebEd\Base\Core\Repositories;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;

use WebEd\Base\Core\Repositories\Traits\EloquentBaseMethods as BaseMethods;
use WebEd\Base\Core\Repositories\Traits\RepositoryRules;

use WebEd\Base\Core\Repositories\Contracts\ModelNeedValidate;
use WebEd\Base\Core\Repositories\Contracts\BaseMethodsContract;

use WebEd\Base\Caching\Repositories\Traits\Cacheable;

abstract class AbstractBaseRepository implements ModelNeedValidate, BaseMethodsContract
{
    use RepositoryRules;

    use BaseMethods;

    use Cacheable;

    /**
     * @var \WebEd\Base\Core\Models\EloquentBase
     */
    private $model;

    public function __construct(BaseModelContract $model)
    {
        $this->model = $model;
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
}
