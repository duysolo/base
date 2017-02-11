<?php namespace WebEd\Base\Core\Http\Controllers;

use Illuminate\Http\Request;
use WebEd\Base\Users\Repositories\Contracts\UserRepositoryContract;
use WebEd\Base\Users\Repositories\UserRepository;

abstract class BaseAdminController extends BaseController
{
    /**
     * @var \WebEd\Base\Core\Support\Breadcrumbs
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
     * @var \WebEd\Base\Core\Services\FlashMessages
     */
    public $flashMessagesHelper;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs = \Breadcrumbs::setBreadcrumbClass('breadcrumb')
            ->setContainerTag('ol')
            ->addLink('WebEd', route('admin::dashboard.index.get'), '<i class="icon-home mr5"></i>');

        $this->middleware(function (Request $request, $next) {
            $this->loggedInUser = $request->user();
            view()->share([
                'loggedInUser' => $this->loggedInUser
            ]);
            \DashboardMenu::setUser($this->loggedInUser);
            return $next($request);
        });

        $this->assets = assets_management()->getAssetsFrom('admin');

        $this->assets
            ->addStylesheetsDirectly([
                'admin/theme/lte/css/AdminLTE.min.css',
                'admin/theme/lte/css/skins/_all-skins.min.css',
                'admin/css/style.css',
            ])
            ->addJavascriptsDirectly([
                'admin/theme/lte/js/app.js',
                'admin/js/webed-core.js',
                'admin/theme/lte/js/demo.js',
                'admin/js/script.js',
            ], 'bottom');

        $this->flashMessagesHelper = flash_messages();

        $this->userRepository = app(UserRepositoryContract::class);
    }

    /**
     * @param null $activeId
     */
    protected function getDashboardMenu($activeId = null)
    {
        \DashboardMenu::setActiveItem($activeId);
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
