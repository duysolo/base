<?php

if (!function_exists('dashboard_menu')) {
    /**
     * @return \WebEd\Base\Menu\Support\DashboardMenu
     */
    function dashboard_menu()
    {
        return \WebEd\Base\Menu\Facades\DashboardMenuFacade::getFacadeRoot();
    }
}
