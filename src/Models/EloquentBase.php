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
     * @var string
     */
    protected $prefix = WEBED_DB_PREFIX;

    public function __construct(array $attributes = [])
    {
        if (isset($this->prefix)) {
            $this->table = $this->prefix . $this->table;
        }

        parent::__construct($attributes);
    }

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
     * @param array|string $attribute
     * @return $this
     */
    public function unsetFillable($attribute)
    {
        $attributes = is_array($attribute) ? $attribute : func_get_args();

        $this->fillable = array_filter($this->fillable, function ($item) use ($attributes) {
            return !in_array($item, $attributes);
        });

        return $this;
    }

    /**
     * This is where to put some scope query
     */
}
