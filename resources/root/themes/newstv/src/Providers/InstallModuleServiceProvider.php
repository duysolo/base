<?php namespace NewsTV\Providers;

use Illuminate\Support\ServiceProvider;

class InstallModuleServiceProvider extends ServiceProvider
{
    protected $moduleAlias = 'webed-theme-' . THEME_NAME;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //acl_permission()
        //    ->registerPermission('Permission 2 description', 'description-2', $this->moduleAlias);
    }
}
