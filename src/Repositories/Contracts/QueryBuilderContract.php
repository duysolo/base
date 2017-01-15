<?php namespace WebEd\Base\Core\Repositories\Contracts;

use WebEd\Base\Core\Models\EloquentBase;

interface QueryBuilderContract
{
    /**
     * Eager loading
     * @param $entityName
     * @return $this
     */
    public function with($entityName);

    /**
     * Select fields
     * @param array $columns
     * @return $this
     */
    public function select($columns = ['*']);

    /**
     * Where operator
     * @param string|array|\Closure $field
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function where($field, $operator = null, $value = null);

    /**
     * Or where operator
     * @param string|array|\Closure $field
     * @param null $operator
     * @param null $value
     * @return $this
     */
    public function orWhere($field, $operator = null, $value = null);

    /**
     * Order by
     * @param $field
     * @param null $value
     * @return $this
     */
    public function orderBy($field, $value = null);

    /**
     * Join to other table
     * @param $joinTo
     * @param $firstTableField
     * @param $operator
     * @param $secondTableField
     * @return $this
     */
    public function join($joinTo, $firstTableField, $operator = null, $secondTableField = null);

    /**
     * Left join to other table
     * @param $joinTo
     * @param $firstTableField
     * @param $operator
     * @param $secondTableField
     * @return $this
     */
    public function leftJoin($joinTo, $firstTableField, $operator = null, $secondTableField = null);

    /**
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param null $page
     * @return $this
     */
    public function paginate($perPage, $columns = ['*'], $pageName = 'page', $page = null);

    /**
     * How many items to take?
     * @param $howManyItem
     * @return $this
     */
    public function take($howManyItem);

    /**
     * How many items that're skipped from query?
     * @param $howManyItem
     * @return $this
     */
    public function skip($howManyItem);

    /**
     * Set current paged
     * @param $paged
     * @return $this
     */
    public function setCurrentPaged($paged);

    /**
     * @return mixed
     */
    public function get();

    /**
     * Get all items
     * @return mixed
     */
    public function all();

    /**
     * Get first item from db
     * @return mixed
     */
    public function first();

    /**
     * Fin item by id and other related fields
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Find item by fields. If not exist, create a new one with these fields
     * @param array $fields
     * @param array $optionalFields
     * @param bool $forceCreate
     * @return EloquentBase
     */
    public function findByFieldsOrCreate($fields, $optionalFields = null, $forceCreate = false);

    /**
     * Reset all query builder data
     * @return mixed
     */
    public function resetQuery();

    /**
     * Get the current query builder data
     * @return mixed
     */
    public function getQueryBuilderData();

    /**
     * Determine current query use join or not
     * @return bool
     */
    public function isUseJoin();

    /**
     *
     * Since 2016-10-15
     *
     */
    /**
     * @param $group
     * @return $this
     */
    public function groupBy($group);

    /**
     * @param $field
     * @param $operator
     * @param $value
     * @return $this
     */
    public function having($field, $operator, $value);

    /**
     * @param $field
     * @return $this
     */
    public function avg($field);

    /**
     * @param $field
     * @return $this
     */
    public function min($field);

    /**
     * @param $field
     * @return $this
     */
    public function max($field);

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function whereExists(\Closure $callback);

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function whereNotExists(\Closure $callback);

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function orWhereExists(\Closure $callback);

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function orWhereNotExists(\Closure $callback);

    /**
     * @param $bool
     * @return $this
     */
    public function inRandomOrder($bool = true);

    /**
     * @param $bool
     * @param \Closure $callback
     * @return $this
     */
    public function when($bool, \Closure $callback);

    /**
     *
     * Since 2017-01-06
     *
     */
    /**
     * @return $this
     */
    public function distinct();

    /**
     * Since 2017-01-13
     */
    /**
     * @return integer
     */
    public function count();
}
