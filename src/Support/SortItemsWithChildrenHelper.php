<?php namespace WebEd\Base\Support;

use Illuminate\Support\Collection;

class SortItemsWithChildrenHelper
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * @var string
     */
    protected $parentField = 'parent_id';

    /**
     * @var string
     */
    protected $compareKey = 'id';

    /**
     * @var string
     */
    protected $childrenProperty = 'children_items';

    /**
     * @var array
     */
    protected $result = [];

    public function __construct()
    {

    }

    /**
     * @param $items
     * @return $this
     * @throws \Exception
     */
    public function setItems($items)
    {
        if (is_array($items)) {
            $this->items = collect($items);
            return $this;
        } elseif ($items instanceof Collection) {
            $this->items = $items;
            return $this;
        }
        throw new \Exception('Items must be array or collection');
    }

    /**
     * @param $string
     * @return $this
     */
    public function setParentField($string)
    {
        $this->parentField = $string;
        return $this;
    }

    /**
     * @param $key
     * @return $this
     */
    public function setCompareKey($key)
    {
        $this->compareKey = $key;
        return $this;
    }

    /**
     * @param $string
     * @return $this
     */
    public function setChildrenProperty($string)
    {
        $this->childrenProperty = $string;
        return $this;
    }

    /**
     * @return array
     */
    public function sort()
    {
        return $this->_sort();
    }

    /**
     * @param null $parentId
     * @return array
     */
    protected function _sort($parentId = null)
    {
        $result = [];
        $filtered = $this->items->where($this->parentField, '=', $parentId);
        foreach ($filtered as $key => $item) {
            if (is_object($item)) {
                $item->{$this->childrenProperty} = $this->_sort($item->{$this->compareKey});
            } else {
                $item[$this->childrenProperty] = $this->_sort(array_get($item, $this->compareKey));
            }
            $result[] = $item;
        }
        return $result;
    }
}
