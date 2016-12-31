<?php namespace WebEd\Base\Core\Repositories\Contracts;

interface UseSoftDeletes
{
    /**
     * @param bool $bool
     * @return $this
     */
    public function withTrashed($bool = true);

    /**
     * @param bool $bool
     * @return $this
     */
    public function onlyTrashed($bool = true);

    /**
     * @param \WebEd\Base\Core\Models\Contracts\BaseModelContract|int|array|null $id
     * @return array
     */
    public function restore($id = null);

    /**
     * @return bool|null
     */
    public function forceDelete();
}
