<?php

if (!function_exists('breadcrumbs')) {
    /**
     * @return \WebEd\Base\Core\Support\Breadcrumbs
     */
    function breadcrumbs()
    {
        return \WebEd\Base\Core\Facades\BreadcrumbsFacade::getFacadeRoot();
    }
}