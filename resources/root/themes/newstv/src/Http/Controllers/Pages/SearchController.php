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
                    webed_db_prefix() . 'posts.status' => 1,
                ],
                'select' => [
                    webed_db_prefix() . 'posts.id',
                    webed_db_prefix() . 'posts.title',
                    webed_db_prefix() . 'posts.slug',
                    webed_db_prefix() . 'posts.description',
                    webed_db_prefix() . 'posts.created_at',
                    webed_db_prefix() . 'posts.thumbnail',
                ],
                'paginate' => [
                    'per_page' => get_theme_option('items_per_page', 9),
                    'current_paged' => ($this->request->input('page') ?: 1),
                ],
            ]);

        return $this->view('front.page-templates.search');
    }
}
