<?php namespace NewsTV\Http\ViewComposers;

use Illuminate\View\View;
use WebEd\Base\Criterias\Filter\WithViewTracker;
use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;

class SidebarViewComposer
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
        $postTopViews = $this->postRepository
            ->pushCriteria(new WithViewTracker($this->postRepository->getModel(), WEBED_BLOG_POSTS))
            ->advancedGet([
                'condition' => [
                    webed_db_prefix() . 'posts.status' => 1,
                ],
                'order_by' => [
                    'view_count' => 'DESC',
                ],
                'select' => [
                    webed_db_prefix() . 'posts.title',
                    webed_db_prefix() . 'posts.slug',
                    webed_db_prefix() . 'posts.id',
                    webed_db_prefix() . 'posts.thumbnail',
                    webed_db_prefix() . 'view_trackers.count as view_count'
                ],
                'take' => 5,
            ]);

        $popularVideos = get_posts([
            'condition' => [
                'page_template' => 'video',
                'status' => 1
            ],
            'order_by' => [
                'is_featured' => 'DESC',
                'created_at' => 'DESC',
            ],
            'select' => ['created_at', 'title', 'slug', 'id', 'thumbnail'],
            'take' => 4
        ]);

        $view->with('popularVideos', $popularVideos)
            ->with('postTopViews', $postTopViews);
    }
}
