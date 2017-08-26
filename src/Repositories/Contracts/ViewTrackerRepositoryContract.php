<?php namespace WebEd\Base\Repositories\Contracts;

use WebEd\Base\Models\Contracts\ViewTrackerModelContract;

interface ViewTrackerRepositoryContract extends AbstractRepositoryContract
{
    /**
     * @param ViewTrackerModelContract $viewTracker
     * @return array
     */
    public function increase(ViewTrackerModelContract $viewTracker);
}
