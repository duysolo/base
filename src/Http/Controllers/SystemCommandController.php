<?php namespace WebEd\Base\Http\Controllers;

class SystemCommandController extends BaseAdminController
{
    protected $module = 'webed-core';

    /**
     * Call command composer dump-autoload
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCallDumpAutoload()
    {
        modules_management()->refreshComposerAutoload();
        flash_messages()
            ->addMessages('Composer autoload refreshed', 'success')
            ->showMessagesOnSession();

        return redirect()->back();
    }

    public function getUpdateCms()
    {
        $modules = get_core_module();

        $app = app();

        $updated = 0;

        foreach ($modules as $namespace => $module) {
            if (
                get_core_module_version($module['alias']) === array_get($module, 'installed_version')
                || !module_version_compare(get_core_module_version($module['alias']), '^' . array_get($module, 'installed_version', 0))
            ) {
                continue;
            }

            $updateModuleProvider = str_replace('\\\\', '\\', array_get($module, 'namespace', '') . '\Providers\UpdateModuleServiceProvider');
            if (class_exists($updateModuleProvider)) {
                $app->register($updateModuleProvider);
            }

            webed_core_modules()->saveModule($module, [
                'installed_version' => get_core_module_version($module['alias']),
            ]);

            $moduleProvider = str_replace('\\\\', '\\', array_get($module, 'namespace', '') . '\Providers\ModuleProvider');
            \Artisan::call('vendor:publish', [
                '--provider' => $moduleProvider,
                '--tag' => 'webed-public-assets',
                '--force' => true
            ]);

            $updated++;
        }

        if ($updated) {
            flash_messages()
                ->addMessages($updated . ' modules updated', 'success');
        } else {
            flash_messages()
                ->addMessages('Your cms already up to date', 'info');
        }
        flash_messages()
            ->showMessagesOnSession();

        return redirect()->back();
    }
}
