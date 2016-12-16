<?php namespace WebEd\Base\Core\Support;

class SEO {
    /**
     * @var array
     */
    protected $seoMeta = [];

    /**
     * @var mixed
     */
    protected $modelObject;

    /**
     * @param $content
     * @return $this
     */
    public function metaDescription($content)
    {
        $this->seoMeta['description'] = $content;
        return $this;
    }

    /**
     * @param $content
     * @return $this
     */
    public function metaKeywords($content)
    {
        $this->seoMeta['keywords'] = $content;
        return $this;
    }

    /**
     * @param $content
     * @return $this
     */
    public function metaRobots($content)
    {
        $this->seoMeta['robots'] = $content;
        return $this;
    }

    /**
     * @param $url
     * @return $this
     */
    public function metaImage($url)
    {
        $this->seoMeta['image'] = $url;
        return $this;
    }

    /**
     * @param $object
     * @return $this
     */
    public function setModelObject($object)
    {
        $this->modelObject = $object;
        return $this;
    }

    /**
     * @return string
     */
    public function render()
    {
        return view('webed-core::front._partials.meta-seo', [
            'seoMeta' => $this->seoMeta,
            'object' => $this->modelObject
        ])->render();
    }
}
