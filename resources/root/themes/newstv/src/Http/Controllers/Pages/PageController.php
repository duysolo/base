<?php namespace NewsTV\Http\Controllers\Pages;

use WebEd\Base\Pages\Models\Contracts\PageModelContract;
use WebEd\Base\Pages\Models\Page;
use WebEd\Base\Pages\Repositories\Contracts\PageRepositoryContract;
use WebEd\Base\Pages\Repositories\PageRepository;
use NewsTV\Http\Controllers\AbstractController;

class PageController extends AbstractController
{
    /**
     * @var Page
     */
    protected $page;

    /**
     * @param PageRepository $repository
     */
    public function __construct(PageRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * @param Page $item
     * @param array $data
     */
    public function handle(PageModelContract $item, array $data)
    {
        $this->dis = $data;

        $this->page = $item;

        $this->getMenu('page', $item->id);

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
        if(view()->exists($this->currentThemeName . '::front.page-templates.' . str_slug($this->page->page_template))) {
            return $this->view('front.page-templates.' . str_slug($this->page->page_template));
        }
        return $this->view('front.page-templates.default');
    }

    /**
     * @return mixed
     */
    protected function _template_Homepage()
    {
        $this->dis['mainFeatures'] = get_posts([
            'condition' => [
                'status' => 1,
                'is_featured' => 1,
            ],
            'take' => 5
        ]);

        $categories = get_categories_with_children([
            'select' => [
                'title', 'status', 'id', 'slug', 'parent_id',
            ],
        ]);

        foreach ($categories as &$category) {
            $categoryIds = [$category->id];
            foreach ($category->child_cats as $child_cat) {
                $categoryIds[] = $child_cat->id;
            }
            $category->fetched_posts = [];
            $category->fetched_posts = get_posts_by_category($categoryIds, [
                'select' => [
                    webed_db_prefix() . 'posts.id',
                    webed_db_prefix() . 'posts.slug',
                    webed_db_prefix() . 'posts.title',
                    webed_db_prefix() . 'posts.thumbnail',
                    webed_db_prefix() . 'posts.created_at',
                ],
                'take' => 6,
            ]);
        }

        $this->dis['categories'] = $categories;

        return $this->view('front.page-templates.homepage');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function _template_ContactUs()
    {
        google_recaptcha()
            ->setLanguage(app()->getLocale())
            ->registerForm('contactFormRecaptcha')
            ->renderScript('front_footer_js');

        return $this->view('front.page-templates.contact-us');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function _template_Videos()
    {
        $this->dis['posts'] = get_posts([
            'select' => [
                webed_db_prefix() . 'posts.id',
                webed_db_prefix() . 'posts.slug',
                webed_db_prefix() . 'posts.title',
                webed_db_prefix() . 'posts.thumbnail',
                webed_db_prefix() . 'posts.created_at',
            ],
            'condition' => [
                'status' => 1,
                'page_template' => 'Video'
            ],
            'paginate' => [
                'per_page' => get_theme_option('items_per_page', 3),
                'current_paged' => $this->request->input('page') ?: 1,
            ],
        ]);

        return $this->view('front.page-templates.video');
    }
}
