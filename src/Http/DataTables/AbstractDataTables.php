<?php namespace WebEd\Base\Http\DataTables;

use Illuminate\Http\JsonResponse;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use Yajra\Datatables\Engines\CollectionEngine;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Engines\QueryBuilderEngine;

abstract class AbstractDataTables
{
    /**
     * @var EloquentBaseRepository|\Illuminate\Support\Collection
     */
    protected $collection;

    protected $filters = [];

    protected $groupActions = [];

    protected $ajaxUrl = [];

    protected $selector = 'table.datatables';

    public $dataTableView = 'webed-core::admin._components.datatables.table';

    /**
     * @var CollectionEngine|EloquentEngine|QueryBuilderEngine|mixed
     */
    protected $fetch;

    /**
     * @param $method
     * @param $params
     * @return mixed
     */
    public function __call($method, $params)
    {
        if (!$this->fetch) {
            $this->fetch = $this->fetchDataForAjax();
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
     * @param int $columnPosition
     * @return $this
     */
    protected function removeFilter($columnPosition)
    {
        if (isset($this->filters[$columnPosition])) {
            unset($this->filters[$columnPosition]);
        }

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
        $headings = $this->headings();
        $columns = json_encode($this->columns());
        $groupActions = $this->groupActions;
        $selector = $this->selector;
        $ajaxUrl = $this->ajaxUrl;

        assets_management()->addJavascripts('jquery-datatables');

        add_action(BASE_ACTION_FOOTER_JS, function () use ($selector, $columns, $ajaxUrl) {
            echo view('webed-core::admin._components.datatables.script-renderer', compact(
                'columns', 'selector', 'ajaxUrl'
            ))->render();
        });

        return view($this->dataTableView, compact(
            'filters', 'headings', 'groupActions'
        ))->render();
    }

    /**
     * @return JsonResponse
     */
    public function ajax()
    {
        $this->fetch = $this->fetchDataForAjax();
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
     * @return array
     */
    abstract public function headings();

    /**
     * @return array
     */
    abstract public function columns();

    /**
     * @return string
     */
    abstract public function run();

    /**
     * @return CollectionEngine|EloquentEngine|QueryBuilderEngine|mixed
     */
    abstract protected function fetchDataForAjax();
}
