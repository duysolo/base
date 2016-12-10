<?php namespace WebEd\Base\Core\Repositories\Contracts;

use WebEd\Base\Core\Models\Contracts\ViewTrackerModelContract;

interface ViewTrackerRepositoryContract
{
    /**
     * @param ViewTrackerModelContract $viewTracker
     * @return array
     */
    public function increase(ViewTrackerModelContract $viewTracker);
}
