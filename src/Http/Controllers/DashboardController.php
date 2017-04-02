<?php namespace WebEd\Base\Http\Controllers;

class DashboardController extends BaseAdminController
{
    protected $module = 'webed-core';

    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        $this->setPageTitle(trans('webed-core::stats.dashboard_statistics'));
        $this->getDashboardMenu('webed-dashboard');
        return do_filter(BASE_FILTER_CONTROLLER, $this, WEBED_DASHBOARD_STATS)->viewAdmin('dashboard');
    }
}
