<?php namespace WebEd\Themes\Triangle\Http\Controllers\Pages;

use WebEd\Base\Pages\Models\Contracts\PageModelContract;
use WebEd\Base\Pages\Models\Page;
use WebEd\Base\Pages\Repositories\Contracts\PageRepositoryContract;
use WebEd\Base\Pages\Repositories\PageRepository;

use WebEd\Themes\Triangle\Http\Controllers\AbstractController;

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
        return $this->view('front.page-templates.default');
    }

    /**
     * @return mixed
     */
    protected function _template_Homepage()
    {
        return $this->view('front.page-templates.homepage');
    }
}
