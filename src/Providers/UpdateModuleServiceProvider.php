<?php namespace WebEd\Base\Providers;

use Illuminate\Support\ServiceProvider;

class UpdateModuleServiceProvider extends ServiceProvider
{
    protected $moduleAlias = 'webed-core';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        register_module_update_batches($this->moduleAlias, [
            '4.0.14' => __DIR__ . '/../../update-batches/4.0.14.php',
        ], 'core');

        load_module_update_batches($this->moduleAlias, 'core');
    }
}
