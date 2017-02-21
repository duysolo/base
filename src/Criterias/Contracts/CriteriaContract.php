<?php namespace WebEd\Base\Core\Criterias\Contracts;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Repositories\AbstractBaseRepository;
use WebEd\Base\Core\Repositories\Contracts\AbstractRepositoryContract;

interface CriteriaContract
{
    /**
     * @param BaseModelContract $model
     * @param AbstractBaseRepository $repository
     * @return mixed
     */
    public function apply($model, AbstractRepositoryContract $repository);
}
