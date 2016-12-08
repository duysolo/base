<?php use Illuminate\Routing\Router;

/**
 *
 * @var Router $router
 *
 */

$adminRoute = config('webed.admin_route');

$router->group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute) {
    $router->get('/', 'DashboardController@getIndex')
        ->name('admin::dashboard.index.get')
        ->middleware('has-permission:access-dashboard');

    $router->get('error/{code}', 'ErrorController@getIndex')
        ->name('admin::error');

    /**
     * Commands
     */
    $router->get('system/call-composer-dump-autoload', 'SystemCommandController@getCallDumpAutoload')
        ->name('admin::system.commands.composer-dump-autoload.get')
        ->middleware('has-permission:use-system-commands');
});

//$router->get('{slugNum?}', 'ResolveSlug@index')->where('slugNum', '(.*)');
