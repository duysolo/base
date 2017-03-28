<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Support\DashboardLanguage;

/**
 * @method static DashboardLanguage setDashboardLanguage(string $slug)
 * @method static DashboardLanguage getDashboardLanguage(string $default = null)
 */
class DashboardLanguageFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DashboardLanguage::class;
    }
}
