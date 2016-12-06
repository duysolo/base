<?php

namespace WebEd\Base\Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class RouteServiceProvider
 * @package WebEd\Base\Core\Providers
 * @author Tedozi Manson <duyphan.developer@gmail.com>
 */
class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'WebEd\Base\Core\Http\Controllers';

    public function map(Router $router)
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}
