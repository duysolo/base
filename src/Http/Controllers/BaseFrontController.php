<?php namespace WebEd\Base\Http\Controllers;

use Illuminate\Routing\Controller;

class BaseFrontController extends BaseController
{
    /**
     * @var mixed|Controller|BaseController
     */
    protected $themeController;

    /**
     * @var string
     */
    protected $currentThemeName = 'webed-theme';

    /**
     * @param $type
     * @param $relatedId
     * @return null|string|mixed
     */
    protected function getMenu($type, $relatedId)
    {
        $menuHtml = webed_render_menu(get_setting('main_menu', 'main-menu'), [
            'class' => 'nav navbar-nav navbar-right',
            'container_class' => 'collapse navbar-collapse',
            'has_sub_class' => 'dropdown',
            'menu_active' => [
                'type' => $type,
                'related_id' => $relatedId,
            ]
        ]);
        view()->share([
            'cmsMenuHtml' => $menuHtml
        ]);
        return $menuHtml;
    }

    /**
     * Override method view of AbstractBase.
     * By now, we will get assets from theme if it exists.
     * @param $viewName
     * @param null $data
     * @param null|string $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function view($viewName, $data = null, $module = null)
    {
        if ($data === null) {
            $data = $this->dis;
        }

        if ($module === null) {
            $module = $this->currentThemeName;
        }

        if(view()->exists($module . '::' . $viewName)) {
            return view($module . '::' . $viewName, $data);
        }
        return view($viewName, $data);
    }
}
