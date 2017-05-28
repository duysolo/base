<?php namespace WebEd\Base\Criterias\Filter;

use Illuminate\Database\Eloquent\Builder;
use WebEd\Base\Criterias\AbstractCriteria;
use WebEd\Base\Repositories\AbstractBaseRepository;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;

class WithEagerLoad extends AbstractCriteria
{
    protected $with;

    public function __construct(array $with)
    {
        $this->with = $with;
    }

    /**
      * @param \WebEd\Base\Models\Contracts\BaseModelContract|Builder $model
      * @param AbstractBaseRepository $repository
      * @return mixed
      */
    public function apply($model, AbstractRepositoryContract $repository)
    {
        return $model->with($this->with);
    }
}
