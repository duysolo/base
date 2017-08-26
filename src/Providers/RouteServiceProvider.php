<?php

namespace WebEd\Base\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'WebEd\Base\Http\Controllers';

    public function boot()
    {
        $this->app->booted(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(__DIR__ . '/../../routes/web.php');
        });
    }
}
