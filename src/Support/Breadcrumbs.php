<?php namespace WebEd\Base\Support;

class Breadcrumbs
{

    /**
     * Links list
     * @var array
     */
    protected $links = [];

    /**
     * Breadcrumb class
     * @var string
     */
    protected $breadcrumbClass = 'breadcrumbs';

    /**
     * Container tag name
     * @var string
     */
    protected $containerTag = 'ul';

    /**
     * Item tag name
     * @var string
     */
    protected $itemTag = 'li';

    /**
     * @param string $title
     * @param string $link
     * @param null|string $icon
     * @return $this
     */
    public function addLink($title, $link = null, $icon = null)
    {
        $this->links[] = $this->templateLink($title, $link, $icon);

        return $this;
    }

    /**
     * Get link template
     * @param string $title
     * @param string $link
     * @param null|string $icon
     * @return string
     */
    protected function templateLink($title, $link = null, $icon = null)
    {
        if (!isset($link)) {
            return '<span>' . $icon . $title . '</span>';
        }
        return '<a title="' . $title . '" href="' . $link . '">' . $icon . $title . '</a>';
    }

    /**
     * Set breadcrumb class
     * @param string $class
     * @return $this
     */
    public function setBreadcrumbClass($class)
    {
        $this->breadcrumbClass = $class;

        return $this;
    }

    /**
     * Set container tag name
     * @param string $tagName
     * @return $this
     */
    public function setContainerTag($tagName)
    {
        $this->containerTag = $tagName;

        return $this;
    }

    /**
     * Set item tag name
     * @param string $tagName
     * @return $this
     */
    public function setItemTag($tagName)
    {
        $this->itemTag = $tagName;

        return $this;
    }

    /**
     * Render the breadcrumb
     * @return string
     */
    public function render()
    {
        $htmlSrc = '<' . $this->containerTag . ' class="' . $this->breadcrumbClass . '">';
        foreach ($this->links as $key => $row) {
            $icon =
            $htmlSrc .= '<' . $this->itemTag . '>' . $row . '</' . $this->itemTag . '>';
        }
        $htmlSrc .= '</' . $this->containerTag . '>';

        return $htmlSrc;
    }

    /**
     * Reset all value to default
     * @return $this
     */
    public function reset()
    {
        $this->links = [];
        $this->breadcrumbClass = 'breadcrumbs';
        $this->containerTag = 'ul';
        $this->itemTag = 'li';

        return $this;
    }
}
