<?php namespace WebEd\Base\Core\Repositories\Contracts;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Models\Contracts\ViewTrackerModelContract;

interface ViewTrackerRepositoryContract
{
    /**
     * @param ViewTrackerModelContract|BaseModelContract $viewTracker
     * @return array
     */
    public function increase(ViewTrackerModelContract $viewTracker);
}
