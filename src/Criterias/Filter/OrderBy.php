<?php namespace WebEd\Base\Criterias\Filter;

use Illuminate\Database\Eloquent\Builder;
use WebEd\Base\Criterias\AbstractCriteria;
use WebEd\Base\Repositories\AbstractBaseRepository;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;

class OrderBy extends AbstractCriteria
{
    /**
     * @var array
     */
    protected $orderBy;

    public function __construct(array $orderBy)
    {
        $this->orderBy = $orderBy;
    }

    /**
      * @param \WebEd\Base\Models\Contracts\BaseModelContract|Builder $model
      * @param AbstractBaseRepository $repository
      * @return mixed
      */
    public function apply($model, AbstractRepositoryContract $repository)
    {
        foreach ($this->orderBy as $by => $direction) {
            $model = $model->orderBy($by, $direction);
        }
        return $model;
    }
}
