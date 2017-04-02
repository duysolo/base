<?php

if (!function_exists('lang')) {
    /**
     * @return \Illuminate\Translation\Translator
     */
    function lang()
    {
        return \Illuminate\Support\Facades\Lang::getFacadeRoot();
    }
}

if (!function_exists('dashboard_language')) {
    /**
     * @return \WebEd\Base\Support\DashboardLanguage
     */
    function dashboard_language()
    {
        return \WebEd\Base\Facades\DashboardLanguageFacade::getFacadeRoot();
    }
}