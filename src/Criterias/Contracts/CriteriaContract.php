<?php namespace WebEd\Base\Criterias\Contracts;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Repositories\AbstractBaseRepository;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;

interface CriteriaContract
{
    /**
     * @param BaseModelContract $model
     * @param AbstractBaseRepository $repository
     * @return mixed
     */
    public function apply($model, AbstractRepositoryContract $repository);
}
