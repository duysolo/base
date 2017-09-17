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
     * @var UpdateCoreModuleAction
     */
    protected $action;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UpdateCoreModuleAction $action)
    {
        parent::__construct();

        $this->action = $action;
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

            $this->info('Updating module: ' . $module['alias']);

            $this->action->run($module['alias']);

            $this->info('Module ' . $module['alias'] . ' has been updated');

            $updated++;
        }
        if (!$updated) {
            $this->error('You have nothing to update');
        }
    }
}
