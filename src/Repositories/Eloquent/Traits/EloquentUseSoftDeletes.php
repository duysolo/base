<?php namespace WebEd\Base\Repositories\Eloquent\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use WebEd\Base\Models\EloquentBase;

/**
 * @property SoftDeletes|EloquentBase $model
 */
trait EloquentUseSoftDeletes
{
    /**
     * @return $this
     */
    public function withTrashed()
    {
        $this->model = $this->model->withTrashed();
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutTrashed()
    {
        $this->model = $this->model->withoutTrashed();
        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function onlyTrashed($bool = true)
    {
        $this->model = $this->model->onlyTrashed();
        return $this;
    }

    /**
     * @param \WebEd\Base\Models\Contracts\BaseModelContract|int|array|null $id
     * @return bool
     */
    public function restore($id = null)
    {
        if ($id) {
            if (is_array($id)) {
                $this->model = $this->model->withTrashed()->whereIn('id', $id);
            } elseif ($id instanceof \Illuminate\Database\Eloquent\SoftDeletes) {
                $this->model = $id;
            } else {
                $this->model = $this->model->withTrashed()->where('id', '=', $id);
            }
        } else {
            $this->applyCriteria();
        }

        try {
            $this->model->restore();
        } catch (\Exception $exception) {
            $this->resetModel();
            return false;
        }
        $this->resetModel();
        return true;
    }

    /**
     * Delete items by id
     * @param \WebEd\Base\Models\Contracts\BaseModelContract|int|array|null $id
     * @return bool
     */
    public function forceDelete($id = null)
    {
        if ($id) {
            if (is_array($id)) {
                $this->model = $this->model->withTrashed()->whereIn('id', $id);
            } elseif ($id instanceof \Illuminate\Database\Eloquent\SoftDeletes) {
                $this->model = $id;
            } else {
                $this->model = $this->model->withTrashed()->where('id', '=', $id);
            }
        } else {
            $this->applyCriteria();
        }

        try {
            $this->model->forceDelete();
        } catch (\Exception $exception) {
            $this->resetModel();
            return false;
        }
        $this->resetModel();
        return true;
    }
}
