<?php namespace WebEd\Base\Repositories;

use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;
use WebEd\Base\Models\ViewTracker;
use WebEd\Base\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;

class ViewTrackerRepository extends EloquentBaseRepository implements ViewTrackerRepositoryContract, CacheableContract
{
    use Cacheable;

    /**
     * @param ViewTracker $viewTracker
     * @return int
     */
    public function increase(ViewTrackerModelContract $viewTracker)
    {
        return $this->update($viewTracker, [
            'count' => $viewTracker->count + 1
        ]);
    }
}
