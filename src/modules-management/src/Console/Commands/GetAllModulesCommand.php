<?php namespace WebEd\Base\ModulesManagement\Console\Commands;

use Illuminate\Console\Command;

class GetAllModulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:get:modules {--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all modules information';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->option('type')) {
            $modules = get_modules_by_type($this->option('type'));
        } else {
            $modules = get_all_module_information();
        }

        $header = ['Name', 'Alias', 'Type', 'Version', 'Namespace', 'Autoload type'];
        $result = [];
        foreach ($modules as $module) {
            $result[] = [
                array_get($module, 'name'),
                array_get($module, 'alias'),
                array_get($module, 'type'),
                array_get($module, 'version'),
                array_get($module, 'namespace'),
                array_get($module, 'autoload'),
            ];
        }

        $this->table($header, $result);
    }
}
