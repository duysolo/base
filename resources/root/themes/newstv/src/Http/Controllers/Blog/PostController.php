<?php namespace NewsTV\Http\Controllers\Blog;

use WebEd\Plugins\Blog\Models\Contracts\PostModelContract;
use WebEd\Plugins\Blog\Models\Post;
use WebEd\Plugins\Blog\Repositories\CategoryRepository;
use WebEd\Plugins\Blog\Repositories\Contracts\CategoryRepositoryContract;
use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;
use NewsTV\Http\Controllers\AbstractController;

class PostController extends AbstractController
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(PostRepositoryContract $repository, CategoryRepositoryContract $categoryRepository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Post $item
     * @return mixed
     */
    public function handle(PostModelContract $item, array $data)
    {
        $this->dis = $data;

        $this->post = $item;

        $this->getMenu('category', $this->dis['categoryIds']);

        breadcrumbs()
            ->setBreadcrumbClass('breadcrumb')
            ->addLink(trans('webed-theme::base.home'), '/', '<i class="fa fa-home" style="margin-right: 5px;"></i>');

        $allCategories = collect(get_categories([
            'condition' => [
                ['id', 'IN', $this->dis['categoryIds']],
            ],
            'select' => [
                'id', 'title', 'slug', 'status', 'parent_id'
            ]
        ]));

        foreach ($allCategories as $category) {
            breadcrumbs()->addLink($category->title, get_category_link($category->slug));
        }

        $happyMethod = '_template_' . studly_case($item->page_template);
        if (method_exists($this, $happyMethod)) {
            return $this->$happyMethod();
        }
        return $this->defaultTemplate();
    }

    /**
     * @return mixed
     */
    protected function defaultTemplate()
    {
        $this->dis['relatedTags'] = $this->repository->getRelatedTags($this->post, [
            'select' => ['id', 'slug', 'title'],
        ]);

        $this->dis['postsInSameCategory'] = $this->repository->getPostsByCategory($this->dis['categoryIds'], [
            'condition' => [
                
            ],
            'select' => [
                webed_db_prefix() . 'posts.id',
                webed_db_prefix() . 'posts.title',
                webed_db_prefix() . 'posts.slug',
                webed_db_prefix() . 'posts.created_at',
                webed_db_prefix() . 'posts.thumbnail',
                webed_db_prefix() . 'posts.order',
            ],
            'take' => 6,
        ]);

        if (view()->exists($this->currentThemeName . '::front.blog.post-templates.' . str_slug($this->post->page_template))) {
            return $this->view('front.blog.post-templates.' . str_slug($this->post->page_template));
        }
        return $this->view('front.blog.post-templates.default');
    }
}
