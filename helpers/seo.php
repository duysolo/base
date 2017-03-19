<?php

if (!function_exists('seo')) {
    /**
     * @return \WebEd\Base\Support\SEO
     */
    function seo()
    {
        return \WebEd\Base\Facades\SeoFacade::getFacadeRoot();
    }
}
