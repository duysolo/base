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

    protected $rules = [

    ];

    protected $editableFields = [
        '*',
    ];

    /**
     * @param ViewTracker $viewTracker
     * @return array
     */
    public function increase(ViewTrackerModelContract $viewTracker)
    {
        return $this->editWithValidate($viewTracker, [
            'count' => $viewTracker->count + 1
        ]);
    }
}
