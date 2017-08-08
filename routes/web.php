<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

$adminRoute = config('webed.admin_route');

Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute) {
    $router->get('/', 'DashboardController@getIndex')
        ->name('admin::dashboard.index.get')
        ->middleware('has-permission:access-dashboard');

    $router->get('/change-language/{slug}', 'DashboardLanguageController@getChangeLanguage')
        ->name('admin::dashboard-language.get');

    /**
     * Commands
     */
    $router->get('system/call-composer-dump-autoload', 'SystemCommandController@getCallDumpAutoload')
        ->name('admin::system.commands.composer-dump-autoload.get')
        ->middleware('has-permission:use-system-commands');

    $router->get('system/update-cms', 'SystemCommandController@getUpdateCms')
        ->name('admin::system.commands.update-cms.get')
        ->middleware('has-permission:use-system-commands');
});

//Route::get('{slugNum?}', 'ResolveSlug@index')->where('slugNum', '(.*)');
