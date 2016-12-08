<?php namespace WebEd\Base\Core\Repositories;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Caching\Services\Contracts\CacheableContract;

use WebEd\Base\Core\Repositories\Contracts\ViewTrackerRepositoryContract;

class ViewTrackerRepository extends AbstractBaseRepository implements ViewTrackerRepositoryContract, CacheableContract
{
    protected $rules = [

    ];

    protected $editableFields = [
        '*',
    ];

    /**
     * @param ViewTrackerModelContract|BaseModelContract $viewTracker
     * @return array
     */
    public function increase(ViewTrackerModelContract $viewTracker)
    {
        return $this->editWithValidate($viewTracker, [
            'count' => $viewTracker->count + 1
        ]);
    }
}
