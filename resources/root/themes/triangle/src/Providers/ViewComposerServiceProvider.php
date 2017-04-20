<?php namespace WebEd\Themes\Triangle\Providers;

use Illuminate\Support\ServiceProvider;
use WebEd\Themes\Triangle\Http\ViewComposers\BlogSidebar;
use WebEd\Themes\Triangle\Http\ViewComposers\FooterViewComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'webed-theme::front._partials.footer',
        ], FooterViewComposer::class);
        view()->composer([
            'webed-theme::front._partials.sidebar',
        ], BlogSidebar::class);
    }
}
