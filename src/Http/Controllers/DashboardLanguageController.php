<?php namespace WebEd\Base\Http\Controllers;

use WebEd\Base\Facades\DashboardLanguageFacade;

class DashboardLanguageController extends BaseAdminController
{
    protected $module = 'webed-core';

    public function __construct()
    {
        parent::__construct();
    }

    public function getChangeLanguage($languageSlug)
    {
        DashboardLanguageFacade::setDashboardLanguage($languageSlug);

        return redirect()->back();
    }
}
