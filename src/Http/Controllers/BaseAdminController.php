<?php namespace WebEd\Base\Http\Controllers;

use Illuminate\Http\Request;
use WebEd\Base\Users\Repositories\Contracts\UserRepositoryContract;
use WebEd\Base\Users\Repositories\UserRepository;

abstract class BaseAdminController extends BaseController
{
    /**
     * @var \WebEd\Base\Support\Breadcrumbs
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
            $this->breadcrumbs = \Breadcrumbs::setBreadcrumbClass('breadcrumb')
                ->setContainerTag('ol')
                ->addLink('WebEd', route('admin::dashboard.index.get'), '<i class="icon-home mr5"></i>');

            $this->loggedInUser = $request->user();
            view()->share([
                'loggedInUser' => $this->loggedInUser
            ]);
            dashboard_menu()->setUser($this->loggedInUser);

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

    /**
     * Set view
     * @param $view
     * @param array|null $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($view, $data = null, $module = null)
    {
        if ($data === null || !is_array($data)) {
            $data = $this->dis;
        }
        if ($module === null) {
            if (property_exists($this, 'module') && $this->module) {
                return view($this->module . '::' . $view, $data);
            }
        }
        return view($view, $data);
    }

    /**
     * Set view admin
     * @param $view
     * @param array|null $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function viewAdmin($view, $data = null, $module = null)
    {
        if ($data === null || !is_array($data)) {
            $data = $this->dis;
        }
        if ($module === null) {
            if (property_exists($this, 'module') && $this->module) {
                return view($this->module . '::admin.' . $view, $data);
            }
        }
        return view('admin.' . $view, $data);
    }

    /**
     * Set view front
     * @param $view
     * @param array|null $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function viewFront($view, $data = null, $module = null)
    {
        if ($data === null || !is_array($data)) {
            $data = $this->dis;
        }
        if ($module === null) {
            if (property_exists($this, 'module') && $this->module) {
                return view($this->module . '::front.' . $view, $data);
            }
        }
        return view('front.' . $view, $data);
    }
}
