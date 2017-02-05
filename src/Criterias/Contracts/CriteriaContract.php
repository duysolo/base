<?php namespace WebEd\Base\Core\Criterias\Contracts;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Repositories\AbstractBaseRepository;
use WebEd\Base\Core\Repositories\Contracts\AbstractRepositoryContract;

interface CriteriaContract
{
    /**
     * @param $model
     * @param AbstractRepositoryContract $repository
     * @param array $crossData
     * @return mixed
     */
    public function apply($model, AbstractRepositoryContract $repository, array $crossData = []);
}
