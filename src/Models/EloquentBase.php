<?php namespace WebEd\Base\Models;

use Illuminate\Database\Eloquent\Model;
use WebEd\Base\Models\Contracts\BaseModelContract;

abstract class EloquentBase extends Model implements BaseModelContract
{
    /**
     * Set primary key of model
     * @var string
     */
    protected $primaryKey = false;

    /**
     * Get primary key
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getKeyName();
    }

    /**
     * @param array|string $attribute
     * @return $this
     */
    public function expandFillable($attribute)
    {
        $attributes = is_array($attribute) ? $attribute : func_get_args();

        $this->fillable = array_unique(array_merge($attributes, $this->fillable));

        return $this;
    }

    /**
     * This is where to put some scope query
     */
}
