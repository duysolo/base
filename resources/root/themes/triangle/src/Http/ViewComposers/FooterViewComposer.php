<?php namespace WebEd\Themes\Triangle\Http\ViewComposers;

use Illuminate\View\View;

class FooterViewComposer
{
    public function __construct()
    {

    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $page = get_pages([
            'take' => 1,
            'condition' => [
                'id' => get_theme_options('footer_content_page', 0)
            ],
        ]);

        if ($page) {
            $view->with([
                'testimonials' => get_field($page, 'testimonials', []),
                'contacts' => get_field($page, 'contacts'),
                'address' => get_field($page, 'address'),
            ]);
        }

    }
}