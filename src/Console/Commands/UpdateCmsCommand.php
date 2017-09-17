<?php namespace WebEd\Base\Console\Commands;

use Illuminate\Console\Command;
use WebEd\Base\ModulesManagement\Actions\UpdateCoreModuleAction;

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
     * Execute the console command.
     */
    public function handle()
    {
        $modules = get_core_module();

        $updated = 0;
        $errors = 0;

        foreach ($modules as $module) {
            if (get_core_module_composer_version(array_get($module, 'repos')) === array_get($module, 'installed_version')) {
                continue;
            }

            $result = app(UpdateCoreModuleAction::class)->run($module['alias']);

            if ($result['error']) {
                foreach ($result['messages'] as $message) {
                    $this->error($message);
                    $errors++;
                }
            } else {
                foreach ($result['messages'] as $message) {
                    $this->info($message);
                    $updated++;
                }
            }
        }
        $this->info($updated . ' modules updated');
        $this->info($errors . ' modules error');
    }
}
