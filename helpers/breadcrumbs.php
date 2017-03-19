<?php

if (!function_exists('breadcrumbs')) {
    /**
     * @return \WebEd\Base\Support\Breadcrumbs
     */
    function breadcrumbs()
    {
        return \WebEd\Base\Facades\BreadcrumbsFacade::getFacadeRoot();
    }
}