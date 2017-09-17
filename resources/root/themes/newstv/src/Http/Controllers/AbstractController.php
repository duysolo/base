<?php namespace NewsTV\Http\Controllers;

use WebEd\Base\Http\Controllers\BaseFrontController;

abstract class AbstractController extends BaseFrontController
{
    /**
     * Override some menu attributes
     *
     * @param $type
     * @param $relatedId
     * @return null|string|mixed
     */
    protected function getMenu($type, $relatedId)
    {
        $menuHtml = webed_render_menu(get_setting('main_menu', 'main-menu'), [
            'id' => '',
            'class' => 'nav navbar-nav navbar-right',
            'container_class' => 'collapse navbar-collapse',
            'has_sub_class' => 'dropdown',
            'container_tag' => 'nav',
            'container_id' => '',
            'group_tag' => 'ul',
            'child_tag' => 'li',
            'submenu_class' => 'sub-menu',
            'item_class' => '',
            'active_class' => 'active current-menu-item',
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
}
