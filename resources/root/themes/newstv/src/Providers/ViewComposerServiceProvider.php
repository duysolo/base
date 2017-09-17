<?php namespace NewsTV\Providers;

use Illuminate\Support\ServiceProvider;
use NewsTV\Http\ViewComposers\FooterViewComposer;
use NewsTV\Http\ViewComposers\HeaderViewComposer;
use NewsTV\Http\ViewComposers\HttpErrorsViewComposer;
use NewsTV\Http\ViewComposers\SidebarViewComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'webed-theme::front._partials.sidebar',
        ], SidebarViewComposer::class);

        view()->composer([
            'webed-theme::front._partials.header',
        ], HeaderViewComposer::class);

        view()->composer([
            'webed-theme::front._partials.footer',
        ], FooterViewComposer::class);

        view()->composer([
            'webed-theme::front.errors.401',
            'webed-theme::front.errors.403',
            'webed-theme::front.errors.404',
            'webed-theme::front.errors.405',
            'webed-theme::front.errors.500',
            'webed-theme::front.errors.503',
        ], HttpErrorsViewComposer::class);
    }
}
