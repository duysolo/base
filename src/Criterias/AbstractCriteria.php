<?php namespace WebEd\Base\Criterias;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;

abstract class AbstractCriteria
{
    /**
     * @param BaseModelContract $model
     * @param AbstractRepositoryContract $repository
     * @return mixed
     */
    abstract public function apply($model, AbstractRepositoryContract $repository);
}
