<?php

if (!function_exists('seo')) {
    /**
     * @return \WebEd\Base\Core\Support\SEO
     */
    function seo()
    {
        return \WebEd\Base\Core\Facades\SeoFacade::getFacadeRoot();
    }
}
