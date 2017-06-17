<?php namespace WebEd\Base\Models\Contracts;

interface BaseModelContract
{
    /**
     * Get primary key
     * @return string
     */
    public function getPrimaryKey();

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable();

    /**
     * @param array|string $attribute
     * @return $this
     */
    public function expandFillable($attribute);
}
