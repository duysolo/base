<?php namespace NewsTV\Providers;

use Illuminate\Support\ServiceProvider;

class UninstallModuleServiceProvider extends ServiceProvider
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
        //    ->unsetPermissionByModule($this->moduleAlias);
    }
}
