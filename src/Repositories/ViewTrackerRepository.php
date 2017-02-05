<?php namespace WebEd\Base\Core\Repositories;

use WebEd\Base\Caching\Services\Traits\Cacheable;
use WebEd\Base\Core\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;
use WebEd\Base\Core\Models\ViewTracker;
use WebEd\Base\Core\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Core\Repositories\Eloquent\EloquentBaseRepository;

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
