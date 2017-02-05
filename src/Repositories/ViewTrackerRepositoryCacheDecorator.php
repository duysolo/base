<?php namespace WebEd\Base\Core\Repositories;

use WebEd\Base\Caching\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Base\Core\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Core\Repositories\Contracts\ViewTrackerRepositoryContract;

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
