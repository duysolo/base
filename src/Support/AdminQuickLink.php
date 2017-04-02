<?php namespace WebEd\Base\Support;

class AdminQuickLink
{
    protected $links = [];

    /**
     * @param $type
     * @param array $linkData
     * @return $this
     */
    public function register($type, array $linkData)
    {
        $linkData = array_merge([
            'title' => null,
            'icon' => null,
            'url' => null,
        ], $linkData);
        $this->links[$type] = $linkData;

        return $this;
    }

    /**
     * @param null $type
     * @return array|mixed
     */
    public function get($type = null)
    {
        if (!$type) {
            return $this->links;
        }
        return array_get($this->links, $type);
    }

    /**
     * @param $type
     * @return $this
     */
    public function remove($type)
    {
        if (array_get($this->links, $type)) {
            unset($this->links[$type]);
        }
        return $this;
    }
}
