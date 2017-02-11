<?php namespace WebEd\Base\Core\Providers;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use WebEd\Base\Core\Exceptions\Handler;
use WebEd\Base\Core\Facades\AdminBarFacade;
use WebEd\Base\Core\Facades\BreadcrumbsFacade;
use WebEd\Base\Core\Facades\FlashMessagesFacade;
use WebEd\Base\Core\Facades\SeoFacade;
use WebEd\Base\Core\Facades\ViewCountFacade;
use WebEd\Base\Core\Support\Helper;

class ModuleProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /*Load views*/
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'webed-core');
        /*Load translations*/
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'webed-core');
        /*Load migrations*/
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->publishes([
            __DIR__ . '/../../resources/views' => config('view.paths')[0] . '/vendor/webed-core',
        ], 'views');
        $this->publishes([
            __DIR__ . '/../../resources/lang' => base_path('resources/lang/vendor/webed-core'),
        ], 'lang');
        $this->publishes([
            __DIR__ . '/../../config' => base_path('config'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../../resources/assets' => resource_path('assets'),
        ], 'webed-assets');
        $this->publishes([
            __DIR__ . '/../../resources/root' => base_path(),
            __DIR__ . '/../../resources/public' => public_path(),
        ], 'webed-public-assets');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Load helpers
        Helper::loadModuleHelpers(__DIR__);

        $this->app->singleton(ExceptionHandler::class, Handler::class);

        //Register related facades
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Breadcrumbs', BreadcrumbsFacade::class);
        $loader->alias('FlashMessages', FlashMessagesFacade::class);
        $loader->alias('AdminBar', AdminBarFacade::class);
        $loader->alias('ViewCount', ViewCountFacade::class);
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('Html', \Collective\Html\HtmlFacade::class);
        $loader->alias('Seo', SeoFacade::class);

        //Merge configs
        $configs = split_files_with_basename($this->app['files']->glob(__DIR__ . '/../../config/*.php'));

        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }

        /**
         * Other packages
         */
        $this->app->register(\Yajra\Datatables\DatatablesServiceProvider::class);
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);

        /**
         * Base providers
         */
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(MiddlewareServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ValidateServiceProvider::class);
        $this->app->register(HookServiceProvider::class);
        $this->app->register(ComposerServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(CollectiveServiceProvider::class);
        $this->app->register(BootstrapModuleServiceProvider::class);

        /**
         * Other module providers
         */
        $this->app->register(\WebEd\Base\Shortcode\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Caching\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\ACL\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\ModulesManagement\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\AssetsManagement\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Auth\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Elfinder\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Hook\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Menu\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Settings\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\ThemesManagement\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Users\Providers\ModuleProvider::class);
        $this->app->register(\WebEd\Base\Pages\Providers\ModuleProvider::class);

        config(['webed.version' => get_cms_version()]);
    }
}
