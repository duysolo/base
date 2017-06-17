<?php namespace WebEd\Base\Http\Controllers;

use Illuminate\Http\Request;
use WebEd\Base\Users\Repositories\Contracts\UserRepositoryContract;
use WebEd\Base\Users\Repositories\UserRepository;
use WebEd\Base\Support\Breadcrumbs;

abstract class BaseAdminController extends BaseController
{
    /**
     * @var Breadcrumbs
     */
    public $breadcrumbs;

    /**
     * @var \WebEd\Base\Users\Models\User
     */
    protected $loggedInUser;

    /**
     * @var \WebEd\Base\AssetsManagement\Assets
     */
    public $assets;

    /**
     * Use to check role
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function (Request $request, $next) {
            $this->breadcrumbs = breadcrumbs()->setBreadcrumbClass('breadcrumb')
                ->setContainerTag('ol')
                ->addLink('WebEd', route('admin::dashboard.index.get'), '<i class="icon-home mr5"></i>');

            $this->loggedInUser = get_current_logged_user();

            view()->share([
                'loggedInUser' => $this->loggedInUser
            ]);

            return $next($request);
        });

        $this->assets = assets_management()->getAssetsFrom('admin');

        $this->userRepository = app(UserRepositoryContract::class);
    }

    /**
     * @param null $activeId
     */
    protected function getDashboardMenu($activeId = null)
    {
        dashboard_menu()->setActiveItem($activeId);
    }
}
