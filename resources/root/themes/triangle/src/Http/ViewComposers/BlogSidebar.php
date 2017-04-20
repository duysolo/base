<?php namespace WebEd\Themes\Triangle\Http\ViewComposers;

use Illuminate\View\View;

class BlogSidebar
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'tags' => get_tags([
                'select' => [
                    'title', 'slug', 'id',
                ],
            ]),
            'popularPosts' => get_posts([
                'condition' => [
                    'status' => 'activated',
                    'is_featured' => 1
                ],
                'order_by' => [
                    'order' => 'ASC',
                    'created_at' => 'DESC',
                ],
                'take' => 5,
                'select' => ['title', 'slug', 'id', 'created_at'],
            ]),
        ]);
    }
}