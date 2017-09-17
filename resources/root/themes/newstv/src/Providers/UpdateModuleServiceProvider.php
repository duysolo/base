<?php namespace NewsTV\Providers;

use Illuminate\Support\ServiceProvider;

class UpdateModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        register_theme_update_batches([
            //'2.1.1' => __DIR__ . '/../../update-batches/2.1.1.php',
            //'2.1.2' => __DIR__ . '/../../update-batches/2.1.2.php',
            //'2.1.3' => __DIR__ . '/../../update-batches/2.1.3.php',
            //'2.1.4' => __DIR__ . '/../../update-batches/2.1.4.php',
        ]);

        load_theme_update_batches();
    }
}
