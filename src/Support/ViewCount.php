<?php namespace WebEd\Base\Support;

use WebEd\Base\Models\Contracts\BaseModelContract;
use WebEd\Base\Models\EloquentBase;
use WebEd\Base\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Repositories\ViewTrackerRepository;

class ViewCount
{
    /**
     * @var ViewTrackerRepositoryContract|ViewTrackerRepository
     */
    protected $repository;

    /**
     * ViewCount constructor.
     * @param ViewTrackerRepository $repository
     */
    public function __construct(ViewTrackerRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param EloquentBase|string $entity
     * @param $entityId
     */
    public function increase($entity, $entityId)
    {
        if ($entity instanceof BaseModelContract) {
            $entity = get_class($entity);
        }
        $viewTracker = $this->repository->findWhereOrCreate([
            'entity' => $entity,
            'entity_id' => $entityId,
        ]);
        return $this->repository->increase($viewTracker);
    }
}
