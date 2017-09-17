<?php namespace NewsTV\Http\Controllers\Blog;

use WebEd\Plugins\Blog\Models\Category;
use WebEd\Plugins\Blog\Models\Contracts\CategoryModelContract;
use WebEd\Plugins\Blog\Repositories\Contracts\CategoryRepositoryContract;
use NewsTV\Http\Controllers\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @var Category
     */
    protected $category;

    public function __construct(CategoryRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * @param Category $item
     * @param array $data
     * @return mixed
     */
    public function handle(CategoryModelContract $item, array $data)
    {
        $this->dis = $data;

        $this->category = $item;

        $this->getMenu('category', $item->id);

        $happyMethod = '_template_' . studly_case($item->page_template);

        if(method_exists($this, $happyMethod)) {
            return $this->$happyMethod();
        }
        return $this->defaultTemplate();
    }

    /**
     * @return mixed
     */
    protected function defaultTemplate()
    {
        $this->dis['relatedPosts'] = get_posts_by_category($this->dis['allRelatedCategoryIds'], [
            'order_by' => [
                webed_db_prefix() . 'posts.created_at' => 'DESC',
                webed_db_prefix() . 'posts.order' => 'ASC',
            ],
            'paginate' => [
                'per_page' => get_theme_option('items_per_page', 5) ?: 5,
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

        if(view()->exists($this->currentThemeName . '::front.blog.category-templates.' . str_slug($this->category->page_template))) {
            return $this->view('front.blog.category-templates.' . str_slug($this->category->page_template));
        }

        return $this->view('front.blog.category-templates.default');
    }
}
