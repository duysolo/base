<?php namespace WebEd\Base\Console\Commands;

use Illuminate\Console\Command;

class UpdateCmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update CMS command';

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->app = app();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modules = get_core_module();

        $updated = 0;

        foreach ($modules as $module) {
            if (
                get_core_module_composer_version(array_get($module, 'repos')) === array_get($module, 'installed_version')
                || module_version_compare(get_core_module_composer_version(array_get($module, 'repos')), '^' . array_get($module, 'installed_version', 0))
            ) {
                continue;
            }
            $this->registerUpdateModuleService($module);
            $updated++;
        }
        if (!$updated) {
            $this->error('You have nothing to update');
        } else {
            \Artisan::call('cache:clear');
        }
    }

    protected function registerUpdateModuleService($module)
    {
        $this->info('Updating module: ' . $module['alias']);

        $updateModuleProvider = str_replace('\\\\', '\\', array_get($module, 'namespace', '') . '\Providers\UpdateModuleServiceProvider');
        if (class_exists($updateModuleProvider)) {
            $this->app->register($updateModuleProvider);
        }

        webed_core_modules()->saveModule($module, [
            'installed_version' => isset($module['version']) ? $module['version'] : get_core_module_composer_version(array_get($module, 'repos')),
        ]);

        $moduleProvider = str_replace('\\\\', '\\', array_get($module, 'namespace', '') . '\Providers\ModuleProvider');
        \Artisan::call('vendor:publish', [
            '--provider' => $moduleProvider,
            '--tag' => 'webed-public-assets',
            '--force' => true
        ]);

        $this->info('Module ' . $module['alias'] . ' has been updated');
    }
}
