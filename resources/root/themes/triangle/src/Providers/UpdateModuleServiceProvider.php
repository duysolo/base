<?php namespace WebEd\Themes\Triangle\Providers;

use Illuminate\Support\ServiceProvider;

class UpdateModuleServiceProvider extends ServiceProvider
{
    protected $module = 'WebEd\Themes\Triangle';

    protected $moduleAlias = 'triangle';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        register_theme_update_batches([
            '1.0.5' => __DIR__ . '/../../update-batches/1.0.5.php',
        ]);
    }

    protected function booted()
    {
        load_theme_update_batches();
    }
}
