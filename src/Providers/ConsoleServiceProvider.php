<?php namespace WebEd\Base\Core\Providers;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
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
        $this->commands([
            \WebEd\Base\Core\Console\Commands\InstallCmsCommand::class,
        ]);
    }
}
