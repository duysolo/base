<?php namespace NewsTV\Http\ViewComposers;

use Illuminate\View\View;
use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;

class HeaderViewComposer
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $popularPosts = get_posts([
            'select' => ['title', 'slug', 'id'],
            'condition' => [
                'is_featured' => 1,
                'status' => 1,
            ],
            'order_by' => [
                'created_at' => 'DESC',
            ],
            'take' => 5
        ]);

        $menuHtml = webed_render_menu(get_setting('main_menu', 'main-menu'), [
            'class' => 'nav navbar-nav',
            'container_class' => null,
            'has_sub_class' => 'dropdown',
            'container_tag' => null,
            'container_id' => '',
            'group_tag' => 'ul',
            'child_tag' => 'li',
            'submenu_class' => 'dropdown-menu',
            'active_class' => 'active current-menu-item',
        ]);

        $topMenuHtml = webed_render_menu(get_theme_option('top_menu', 'top-menu'), [
            'class' => 'pull-left',
            'container_class' => null,
            'has_sub_class' => '',
            'container_tag' => null,
            'container_id' => '',
            'group_tag' => 'ul',
            'child_tag' => 'li',
        ]);

        $view
            ->with('globalTopMenuHtml', $topMenuHtml)
            ->with('globalMenuHtml', $menuHtml)
            ->with('popularPosts', $popularPosts);
    }
}
