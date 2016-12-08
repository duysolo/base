<?php namespace WebEd\Base\Core\Support;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;
use WebEd\Base\Core\Models\EloquentBase;
use WebEd\Base\Core\Repositories\Contracts\ViewTrackerRepositoryContract;
use WebEd\Base\Core\Repositories\ViewTrackerRepository;

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
        $viewTracker = $this->repository->findByFieldsOrCreate([
            'entity' => $entity,
            'entity_id' => $entityId,
        ]);
        return $this->repository->increase($viewTracker);
    }
}
