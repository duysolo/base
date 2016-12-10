<?php namespace WebEd\Base\Core\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use WebEd\Base\Core\Http\Middleware\AdminBarMiddleware;
use WebEd\Base\Core\Http\Middleware\ConstructionModeMiddleware;

class MiddlewareServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(!is_in_dashboard()) {
            /**
             * @var Router $router
             */
            $router = $this->app['router'];
            $router->pushMiddlewareToGroup('web', ConstructionModeMiddleware::class);
            $router->pushMiddlewareToGroup('web', AdminBarMiddleware::class);
        }
    }
}
