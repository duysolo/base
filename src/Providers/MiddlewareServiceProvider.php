<?php namespace WebEd\Base\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use WebEd\Base\Http\Middleware\AdminBarMiddleware;
use WebEd\Base\Http\Middleware\BootstrapModuleMiddleware;
use WebEd\Base\Http\Middleware\ConstructionModeMiddleware;
use WebEd\Base\Http\Middleware\CorsMiddleware;
use WebEd\Base\Http\Middleware\DashboardLanguageMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * @var Router $router
         */
        $router = $this->app['router'];

        if(!is_admin_panel()) {
            $router->pushMiddlewareToGroup('web', ConstructionModeMiddleware::class);
            $router->pushMiddlewareToGroup('web', AdminBarMiddleware::class);
            $router->pushMiddlewareToGroup('api', CorsMiddleware::class);
        } else {
            $router->pushMiddlewareToGroup('web', DashboardLanguageMiddleware::class);
        }
    }
}
