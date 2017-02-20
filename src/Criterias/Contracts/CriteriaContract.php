<?php namespace WebEd\Base\Core\Criterias\Contracts;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Repositories\AbstractBaseRepository;
use WebEd\Base\Core\Repositories\Contracts\AbstractRepositoryContract;

interface CriteriaContract
{
    /**
     * @param $model
     * @param $repository
     * @param array $crossData
     * @return mixed
     */
    public function apply($model, $repository, array $crossData = []);
}
