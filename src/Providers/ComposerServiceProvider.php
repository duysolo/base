<?php namespace WebEd\Base\Core\Providers;

use Illuminate\Support\ServiceProvider;
use WebEd\Base\Core\Http\ViewComposers\AdminBreadcrumbsViewComposer;
use WebEd\Base\Core\Http\ViewComposers\BasePartialsViewComposer;

class ComposerServiceProvider extends ServiceProvider
{
    protected $module = 'WebEd\Base\Core';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'webed-core::admin._partials.breadcrumbs',
        ], AdminBreadcrumbsViewComposer::class);
        view()->composer([
            'webed-core::front._admin-bar',
            'webed-core::admin._partials.header',
            'webed-core::admin._partials.sidebar',
        ], BasePartialsViewComposer::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
