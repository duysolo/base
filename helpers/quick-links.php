<?php

if (!function_exists('admin_quick_link')) {
    /**
     * @return \WebEd\Base\Support\AdminQuickLink
     */
    function admin_quick_link()
    {
        return \WebEd\Base\Facades\AdminQuickLinkFacade::getFacadeRoot();
    }
}