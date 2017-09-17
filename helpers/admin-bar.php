<?php

if (!function_exists('admin_bar')) {
    /**
     * @return \WebEd\Base\Support\AdminBar
     */
    function admin_bar()
    {
        return \WebEd\Base\Facades\AdminBarFacade::getFacadeRoot();
    }
}
