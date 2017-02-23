<?php namespace WebEd\Base\Core\Criterias\Filter;

use Illuminate\Database\Eloquent\Builder;
use WebEd\Base\Core\Models\EloquentBase;
use WebEd\Base\Core\Repositories\Contracts\AbstractRepositoryContract;
use WebEd\Base\Core\Criterias\AbstractCriteria;

class WithViewTracker extends AbstractCriteria
{
    protected $relatedModel;

    public function __construct(EloquentBase $relatedModel)
    {
        $this->relatedModel = $relatedModel;
    }

    /**
     * @param EloquentBase|Builder $model
     * @param AbstractRepositoryContract $repository
     * @return mixed
     */
    public function apply($model, AbstractRepositoryContract $repository)
    {
        return $model
            ->join('view_trackers', $this->relatedModel->getTable() . '.' . $this->relatedModel->getPrimaryKey(), '=', 'view_trackers.entity_id')
            ->where('view_trackers.entity', '=', get_class($this->relatedModel));
    }
}
