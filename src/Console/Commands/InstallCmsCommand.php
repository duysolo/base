<?php namespace WebEd\Base\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use WebEd\Base\ACL\Models\Role;
use WebEd\Base\ACL\Repositories\Contracts\RoleRepositoryContract;
use WebEd\Base\ACL\Repositories\RoleRepository;
use WebEd\Base\ModulesManagement\Repositories\Contracts\CoreModuleRepositoryContract;
use WebEd\Base\ModulesManagement\Repositories\CoreModuleRepository;
use WebEd\Base\Providers\InstallModuleServiceProvider;
use WebEd\Base\Users\Repositories\Contracts\UserRepositoryContract;
use WebEd\Base\Users\Repositories\UserRepository;

class InstallCmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install WebEd';

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * @var array
     */
    protected $container = [];

    /**
     * @var array
     */
    protected $dbInfo = [];

    /**
     * @var Role
     */
    protected $role;

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $app;

    /**
     * @var CoreModuleRepository
     */
    protected $coreModuleRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Filesystem $filesystem,
        CoreModuleRepositoryContract $coreModuleRepository,
        RoleRepositoryContract $roleRepository,
        UserRepositoryContract $userRepository
    )
    {
        parent::__construct();

        $this->files = $filesystem;

        $this->app = app();

        $this->coreModuleRepository = $coreModuleRepository;

        $this->roleRepository = $roleRepository;

        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->createEnv();

        $this->getDatabaseInformation();
        /**
         * Migrate tables
         */
        $this->line('Migrate database...');
        $this->app->register(InstallModuleServiceProvider::class);

        $this->line('Create super admin role...');
        $this->createSuperAdminRole();
        $this->line('Create admin user...');
        $this->createAdminUser();
        $this->line('Install module dependencies...');
        $this->registerInstallModuleService();

        session()->flush();
        session()->regenerate();
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');

        $this->info("\nWebEd installed. Current version is " . get_cms_version());
    }

    /**
     * Get database information
     */
    protected function getDatabaseInformation()
    {
        $this->dbInfo['connection'] = env('DB_CONNECTION');
        $this->dbInfo['host'] = env('DB_HOST');
        $this->dbInfo['database'] = env('DB_DATABASE');
        $this->dbInfo['username'] = env('DB_USERNAME');
        $this->dbInfo['password'] = env('DB_PASSWORD');
        $this->dbInfo['port'] = env('DB_PORT');

        if (!check_db_connection()) {
            $this->error('Please setup your database information first!');
            die();
        }

        $this->info('Database OK...');
    }

    protected function createSuperAdminRole()
    {
        $this->role = $this->roleRepository->findWhereOrCreate([
            'slug' => 'super-admin',
        ], [
            'name' => 'Super Admin',
        ]);
    }

    protected function createAdminUser()
    {
        try {
            $user = $this->userRepository->find($this->userRepository->create([
                'username' => $this->ask('Your username', 'admin'),
                'email' => $this->ask('Your email', 'admin@webed.com'),
                'password' => $this->secret('Your password'),
                'display_name' => $this->ask('Your display name', 'Super Admin'),
                'first_name' => $this->ask('Your first name', 'Admin'),
                'last_name' => $this->ask('Your last name', false),
            ]));
            if ($this->role) {
                $this->role->users()->save($user);
            }
            $this->info('User created successfully...');
        } catch (\Exception $exception) {
            $this->error('Error occurred when create user...');
        }
    }

    protected function registerInstallModuleService()
    {
        $data = [
            'alias' => 'webed-core',
        ];

        $cmsVersion = get_cms_version();

        $baseCore = $this->coreModuleRepository->findWhere($data);

        if (!$baseCore) {
            $this->coreModuleRepository->create(array_merge($data, [
                'installed_version' => $cmsVersion,
            ]));
        } else {
            $this->coreModuleRepository->update($baseCore, [
                'installed_version' => get_cms_version(),
            ]);
        }

        $modules = get_core_module()->where('namespace', '!=', 'WebEd\Base');

        $corePackages = get_composer_modules();

        foreach ($modules as $module) {
            $namespace = str_replace('\\\\', '\\', $module['namespace'] . '\Providers\InstallModuleServiceProvider');
            if (class_exists($namespace)) {
                $this->app->register($namespace);
            }
            $currentPackage = $corePackages->where('name', '=', $module['repos'])->first();
            $data = [
                'alias' => $module['alias'],
            ];
            if ($currentPackage) {
                $data['installed_version'] = isset($module['version']) ? $module['version'] : $currentPackage['version'];
            }
            $coreModule = $this->coreModuleRepository->findWhere([
                'alias' => $module['alias'],
            ]);
            $this->coreModuleRepository->createOrUpdate($coreModule, $data);
        }
        \Artisan::call('vendor:publish', [
            '--tag' => 'webed-public-assets',
            '--force' => true,
        ]);
        \Artisan::call('cache:clear');
    }

    /**
     * @return string
     */
    protected function createEnv()
    {
        $env = $this->files->exists('.env') ? $this->files->get('.env') : $this->files->get('.env.example') ?: '';
        $this->files->put('.env', $env);
        return $env;
    }
}
