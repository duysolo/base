<?php namespace WebEd\Base\Providers;

use Illuminate\Support\ServiceProvider;
use WebEd\Base\Hook\StoreSettingsHook;

class HookServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        add_filter(BASE_FILTER_BEFORE_UPDATE, [StoreSettingsHook::class, 'execute'], 30);
    }
}
