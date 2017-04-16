<?php namespace WebEd\Themes\Triangle\Http\Controllers\Blog;

use WebEd\Plugins\Blog\Models\Contracts\BlogTagModelContract;
use WebEd\Plugins\Blog\Models\Post;
use WebEd\Plugins\Blog\Repositories\Contracts\BlogTagRepositoryContract;
use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;
use WebEd\Themes\Triangle\Http\Controllers\AbstractController;

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

        $this->dis['relatedPosts'] = get_posts_by_tag($item->id);

        return $this->view('front.tag-templates.default');
    }
}
