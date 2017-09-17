<?php namespace NewsTV\Http\ViewComposers;

use Illuminate\View\View;

class FooterViewComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $footerMenuHtml = webed_render_menu(get_setting('footer_menu', 'footer-menu'), [
            'class' => 'footer-menu',
            'container_class' => null,
            'has_sub_class' => '',
            'container_tag' => null,
            'container_id' => '',
            'group_tag' => 'ul',
            'child_tag' => 'li',
            'submenu_class' => '',
        ]);

        $view
            ->with('footerMenuHtml', $footerMenuHtml);
    }
}
