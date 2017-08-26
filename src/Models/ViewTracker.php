<?php namespace WebEd\Base\Models;

use WebEd\Base\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Models\EloquentBase as BaseModel;

class ViewTracker extends BaseModel implements ViewTrackerModelContract
{
    protected $table = 'view_trackers';

    protected $primaryKey = 'id';

    protected $fillable = ['entity', 'entity_id', 'count'];

    public $timestamps = false;

    /**
     * Count getter
     * @param $value
     * @return int
     */
    public function getCountAttribute($value)
    {
        return (int)$value;
    }
}
