<?php namespace WebEd\Themes\Triangle\Http\Controllers\Pages;

use WebEd\Plugins\Blog\Repositories\Contracts\PostRepositoryContract;
use WebEd\Plugins\Blog\Repositories\PostRepository;
use WebEd\Themes\Triangle\Criterias\Filters\SearchPostsCriteria;
use WebEd\Themes\Triangle\Http\Controllers\AbstractController;

class SearchController extends AbstractController
{
    protected $module = 'triangle';

    public function __construct()
    {
        parent::__construct();

        $this->setPageTitle('Search posts');
    }

    /**
     * @param PostRepository $postRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function handle(PostRepositoryContract $postRepository)
    {
        $k = $this->request->get('k');

        $this->dis['posts'] = $postRepository
            ->pushCriteria(new SearchPostsCriteria(
                $k,
                [
                    'posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.created_at', 'posts.thumbnail',
                    'posts.page_template'
                ],
                [
                    'posts.id', 'posts.title', 'posts.slug', 'posts.description', 'posts.created_at', 'posts.thumbnail',
                    'posts.page_template'
                ]
            ))
            ->paginate(get_theme_option('items_per_page', 3), ['*'], $this->request->get('page') ?: 1);

        return $this->view('front.page-templates.search');
    }
}
