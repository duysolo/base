<?php namespace WebEd\Base\Repositories;

use WebEd\Base\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Models\ViewTracker;
use WebEd\Base\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;

class ViewTrackerRepository extends EloquentBaseRepository implements ViewTrackerRepositoryContract
{
    /**
     * @param string $entityName
     * @param string $entityId
     * @return int
     */
    public function increase($entityName, $entityId)
    {
        $viewTracker = $this->findWhereOrCreate([
            'entity' => $entityName,
            'entity_id' => $entityId,
        ]);

        $this->update($viewTracker, [
            'count' => $viewTracker->count + 1
        ]);
        return $viewTracker->count + 1;
    }
}
