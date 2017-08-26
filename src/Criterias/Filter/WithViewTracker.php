<?php namespace WebEd\Base\Criterias\Filter;

use Illuminate\Database\Eloquent\Builder;
use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Models\EloquentBase;
use WebEd\Base\Repositories\Contracts\AbstractRepositoryContract;
use WebEd\Base\Criterias\AbstractCriteria;

class WithViewTracker extends AbstractCriteria
{
    /**
     * @var BaseModelContract
     */
    protected $relatedModel;

    /**
     * @var string
     */
    protected $screenName;

    public function __construct(BaseModelContract $relatedModel, $screenName)
    {
        $this->relatedModel = $relatedModel;

        $this->screenName = $screenName;
    }

    /**
     * @param EloquentBase|Builder $model
     * @param AbstractRepositoryContract $repository
     * @return mixed
     */
    public function apply($model, AbstractRepositoryContract $repository)
    {
        return $model
            ->leftJoin(webed_db_prefix() . 'view_trackers', $this->relatedModel->getTable() . '.' . $this->relatedModel->getPrimaryKey(), '=', webed_db_prefix() . 'view_trackers.entity_id')
            ->where(webed_db_prefix() . 'view_trackers.entity', '=', $this->screenName);
    }
}
