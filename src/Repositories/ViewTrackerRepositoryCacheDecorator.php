<?php namespace WebEd\Base\Repositories;

use WebEd\Base\Repositories\Eloquent\EloquentBaseRepositoryCacheDecorator;

use WebEd\Base\Models\Contracts\ViewTrackerModelContract;
use WebEd\Base\Repositories\Contracts\ViewTrackerRepositoryContract;

class ViewTrackerRepositoryCacheDecorator extends EloquentBaseRepositoryCacheDecorator  implements ViewTrackerRepositoryContract
{
    /**
     * @param string $entityName
     * @param string $entityId
     * @return mixed
     */
    public function increase($entityName, $entityId)
    {
        return $this->afterUpdate(__FUNCTION__, func_get_args());
    }
}
