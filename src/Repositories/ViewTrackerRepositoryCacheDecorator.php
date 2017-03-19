<?php namespace WebEd\Base\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Base\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Repositories\Contracts\ViewTrackerRepositoryContract;

class ViewTrackerRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator  implements ViewTrackerRepositoryContract
{
    /**
     * @param ViewTrackerModelContract $viewTracker
     * @return array
     */
    public function increase(ViewTrackerModelContract $viewTracker)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
