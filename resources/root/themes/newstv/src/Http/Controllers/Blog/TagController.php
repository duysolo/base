<?php namespace NewsTV\Http\Controllers\Blog;

use WebEd\Plugins\Blog\Models\Contracts\BlogTagModelContract;
use WebEd\Plugins\Blog\Models\Post;
use WebEd\Plugins\Blog\Repositories\Contracts\BlogTagRepositoryContract;
use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;
use NewsTV\Http\Controllers\AbstractController;

class TagController extends AbstractController
{
    /**
     * @var Post
     */
    protected $tag;

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @var PostRepository
     */
    protected $postRepository;

    public function __construct(BlogTagRepositoryContract $repository, PostRepositoryContract $postRepository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->postRepository = $postRepository;
    }

    /**
     * @param Post $item
     * @return mixed
     */
    public function handle(BlogTagModelContract $item, array $data)
    {
        $this->dis = $data;

        $this->tag = $item;

        $this->dis['relatedPosts'] = get_posts_by_tag($item->id, [
            'paginate' => [
                'per_page' => get_theme_option('items_per_page', 3),
                'current_paged' => $this->request->input('page') ?: 1,
            ],
            'select' => [
                webed_db_prefix() . 'posts.id',
                webed_db_prefix() . 'posts.title',
                webed_db_prefix() . 'posts.order',
                webed_db_prefix() . 'posts.created_at',
                webed_db_prefix() . 'posts.thumbnail',
                webed_db_prefix() . 'posts.slug',
            ],
        ]);

        return $this->view('front.blog.tag-templates.default');
    }
}
