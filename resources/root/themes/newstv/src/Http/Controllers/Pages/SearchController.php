<?php namespace NewsTV\Http\Controllers\Pages;

use NewsTV\Criterias\SearchPostsCriteria;
use NewsTV\Http\Controllers\AbstractController;
use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;

class SearchController extends AbstractController
{
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepositoryContract $repository)
    {
        parent::__construct();

        $this->repository = $repository;

        $this->setPageTitle('Search');
    }

    public function index()
    {
        $k = $this->request->input('k');

        $this->dis['posts'] = $this->repository
            ->pushCriteria(new SearchPostsCriteria($k))
            ->advancedGet([
                'condition' => [
                    webed_db_prefix() . 'posts.id' => 1,
                ],
                'select' => [
                    'posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.created_at', 'posts.thumbnail',
                    'posts.page_template'
                ],
                'paginate' => [
                    'per_page' => get_theme_option('items_per_page', 10),
                    'current_paged' => ($this->request->input('page') ?: 1),
                ],
            ]);

        return $this->view('front.page-templates.search');
    }
}
