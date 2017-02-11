<?php namespace WebEd\Base\Core\Http\DataTables;

use FontLib\TrueType\Collection;
use Illuminate\Http\JsonResponse;
use WebEd\Base\Core\Repositories\Eloquent\EloquentBaseRepository;
use Yajra\Datatables\Engines\CollectionEngine;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Engines\QueryBuilderEngine;

abstract class AbstractDataTables
{
    /**
     * @var EloquentBaseRepository|Collection
     */
    protected $collection;

    protected $headings = [];

    protected $filters = [];

    protected $columns = [];

    protected $groupActions = [];

    protected $ajaxUrl = [];

    protected $selector = 'table.datatables';

    /**
     * @var CollectionEngine|EloquentEngine|QueryBuilderEngine|mixed
     */
    protected $fetch;

    public function __construct()
    {
        $this->fetch();
    }

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if (!$this->fetch) {
            $this->fetch();
        }
        call_user_func_array([$this->fetch, $method], $params);

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        header('Content-Type: application/json');
        return json_encode($this->ajax()->getData());
    }

    /**
     * @param $selector
     * @return $this
     */
    protected function setDataTableSelector($selector)
    {
        $this->selector = $selector;

        return $this;
    }

    /**
     * @param $url
     * @param string $method
     * @return $this
     */
    protected function setAjaxUrl($url, $method = 'POST')
    {
        $this->ajaxUrl = [$url, $method];

        return $this;
    }

    /**
     * @param $columns
     * @return $this
     */
    protected function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * @param int $columnPosition
     * @param string $htmlElement
     * @return $this
     */
    protected function addFilter($columnPosition, $htmlElement)
    {
        $this->filters[$columnPosition] = $htmlElement;

        return $this;
    }

    /**
     * @param $name
     * @param $title
     * @param $width
     * @return $this
     */
    protected function addHeading($name, $title, $width)
    {
        $this->headings[$name] = ['title' => $title, 'width' => $width];

        return $this;
    }

    protected function withGroupActions(array $actions)
    {
        $this->groupActions = $actions;
    }

    /**
     * @return string
     */
    protected function view()
    {
        $filters = $this->filters;
        $headings = $this->headings;
        $columns = json_encode($this->columns);
        $groupActions = $this->groupActions;
        $selector = $this->selector;
        $ajaxUrl = $this->ajaxUrl;

        \Assets::addJavascripts('jquery-datatables');

        add_action('footer_js', function () use ($selector, $columns, $ajaxUrl) {
            echo view('webed-core::admin._components.datatables.script-renderer', compact(
                'columns', 'selector', 'ajaxUrl'
            ))->render();
        });

        return view('webed-core::admin._components.datatables.table', compact(
            'filters', 'headings', 'groupActions'
        ))->render();
    }

    /**
     * @return JsonResponse
     */
    public function ajax()
    {
        return $this->fetch->make(true, true);
    }

    /**
     * @return mixed|CollectionEngine|EloquentEngine|QueryBuilderEngine
     */
    public function getDataTableData()
    {
        return $this->fetch;
    }

    /**
     * @param CollectionEngine|EloquentEngine|QueryBuilderEngine|mixed $engine
     * @return $this
     */
    public function setDataTableData($engine)
    {
        $this->fetch = $engine;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function run();


    /**
     * @return $this
     */
    abstract protected function fetch();
}
