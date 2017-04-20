<?php namespace WebEd\Themes\Triangle\Http\Controllers\Blog;

use WebEd\Plugins\Blog\Models\Category;
use WebEd\Plugins\Blog\Models\Contracts\CategoryModelContract;
use WebEd\Plugins\Blog\Repositories\Contracts\CategoryRepositoryContract;
use WebEd\Themes\Triangle\Http\Controllers\AbstractController;

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
        $this->dis['relatedPosts'] = get_posts_by_category($this->category->id, [
            'select' => [
                'posts.id', 'posts.title', 'posts.slug', 'posts.created_at',
                'posts.updated_at', 'posts.created_by', 'posts.category_id',
                'posts.content', 'posts.description', 'posts.keywords', 'posts.order', 'posts.thumbnail',
            ],
            'group_by' => [
                'posts.id', 'posts.title', 'posts.slug', 'posts.created_at',
                'posts.updated_at', 'posts.created_by', 'posts.category_id',
                'posts.content', 'posts.description', 'posts.keywords', 'posts.order', 'posts.thumbnail'
            ],
            'with' => ['tags', 'author', 'category'],
            'paginate' => [
                'per_page' => get_theme_option('items_per_page', 6),
                'current_paged' => request()->get('page', 1),
            ],
        ]);

        return $this->view('front.category-templates.default');
    }
}
