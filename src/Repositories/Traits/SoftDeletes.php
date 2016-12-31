<?php namespace WebEd\Base\Core\Repositories\Traits;

trait SoftDeletes
{
    private $withTrashed;

    private $onlyTrashed;

    /**
     * @param bool $bool
     * @return $this
     */
    public function withTrashed($bool = true)
    {
        $this->withTrashed = !!$bool;

        return $this;
    }

    /**
     * @param bool $bool
     * @return $this
     */
    public function onlyTrashed($bool = true)
    {
        $this->onlyTrashed = !!$bool;

        return $this;
    }

    /**
     * @param \WebEd\Base\Core\Models\Contracts\BaseModelContract|int|array|null $id
     * @return array
     */
    public function restore($id = null)
    {
        $models = $this->getModel();

        if ($id) {
            if (is_array($id)) {
                $models = $this->getModel()->withTrashed()->whereIn('id', $id);
            } elseif ($id instanceof \Illuminate\Database\Eloquent\SoftDeletes) {
                $models = $id;
            } else {
                $models = $this->getModel()->withTrashed()->where('id', '=', $id);
            }
        } else {
            $models = $this->convertWhereQuery($models);
        }

        /**
         * In order to use method delete from Eloquent
         * Comment this line to use delete method in QueryBuilder
         */
        $models = $models->get();

        try {
            foreach ($models as $model) {
                $model->restore();
            }
        } catch (\Exception $exception) {
            $this->resetQuery();
            return $this->setMessages([$exception->getMessage()], true, \Constants::ERROR_CODE);
        }
        $this->resetQuery();
        return $this->setMessages(['Request completed'], false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }

    /**
     * Delete items by id
     * @param \WebEd\Base\Core\Models\Contracts\BaseModelContract|int|array|null $id
     * @return array
     */
    public function forceDelete($id = null)
    {
        $models = $this->getModel();

        if ($id) {
            if (is_array($id)) {
                $models = $this->getModel()->withTrashed()->whereIn('id', $id);
            } elseif ($id instanceof \Illuminate\Database\Eloquent\SoftDeletes) {
                $models = $id;
            } else {
                $models = $this->getModel()->withTrashed()->where('id', '=', $id);
            }
        } else {
            $models = $this->convertWhereQuery($models);
        }

        /**
         * In order to use method delete from Eloquent
         * Comment this line to use delete method in QueryBuilder
         */
        $models = $models->get();

        try {
            foreach ($models as $model) {
                $model->forceDelete();
            }
        } catch (\Exception $exception) {
            $this->resetQuery();
            return $this->setMessages([$exception->getMessage()], true, \Constants::ERROR_CODE);
        }
        $this->resetQuery();
        return $this->setMessages(['Request completed'], false, \Constants::SUCCESS_NO_CONTENT_CODE);
    }
}
