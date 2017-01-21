<?php namespace WebEd\Base\Core\Repositories\Traits;

trait WithViewTracker
{
    /**
     * @return $this
     */
    public function withViewTracker()
    {
        $tableName = $this->getTable();
        $primaryKey = $this->getPrimaryKey();
        return $this->join('view_trackers', $tableName . '.' . $primaryKey, '=', 'view_trackers.entity_id')
            ->where('view_trackers.entity', '=', get_class($this->model));
    }
}