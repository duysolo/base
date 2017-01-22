<?php namespace WebEd\Base\Core\Repositories\Contracts;

use WebEd\Base\Core\Models\Contracts\BaseModelContract;

interface BaseMethodsContract
{
    /**
     * Create a new item.
     * Only fields listed in $fillable of model can be filled
     * @param array $data
     * @return static model
     */
    public function create(array $data);

    /**
     * Create a new item, no validate
     * @param $data
     * @return \WebEd\Base\Core\Models\EloquentBase
     */
    public function forceCreate(array $data);

    /**
     * @param $id
     * @return \WebEd\Base\Core\Models\EloquentBase
     */
    public function findOrNew($id);

    /**
     * Validate model then edit
     * @param \WebEd\Base\Core\Models\EloquentBase|\Illuminate\Database\Eloquent\Model|int $id
     * @param $data
     * @param bool $allowCreateNew
     * @param bool $justUpdateSomeFields
     * @return array
     */
    public function editWithValidate($id, array $data, $allowCreateNew = false, $justUpdateSomeFields = false);

    /**
     * Find items by ids and edit them
     * @param $ids
     * @param $data
     * @param bool $justUpdateSomeFields
     * @return array
     */
    public function updateMultiple(array $ids, array $data, $justUpdateSomeFields = false);

    /**
     * Find items by fields and edit them
     * @param $data
     * @param bool $justUpdateSomeFields
     * @return array
     */
    public function update(array $data, $justUpdateSomeFields = false);

    /**
     * Delete items by id
     * @param int|array $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param BaseModelContract $model
     * @return $this
     */
    public function pushModel(BaseModelContract $model);

    /**
     * @param $class
     * @param $method
     * @return $this
     */
    public function pushCriteria($class, $method);

    /**
     * @param $class
     * @param $method
     * @param array $args
     * @return mixed
     */
    public function getByCriteria($class, $method, array $args);
}
