<?php namespace WebEd\Base\Http\DataTables;

use Illuminate\Http\JsonResponse;
use WebEd\Base\Repositories\Eloquent\EloquentBaseRepository;
use Yajra\DataTables\CollectionDataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\QueryDataTable;

abstract class AbstractDataTables
{
    /**
     * @var EloquentBaseRepository|\Illuminate\Support\Collection
     */
    protected $collection;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var array
     */
    protected $groupActions = [];

    /**
     * @var array
     */
    protected $ajaxUrl = [];

    /**
     * @var string
     */
    protected $selector = 'table.datatables';

    /**
     * @var string
     */
    protected $screenName;

    /**
     * @var string
     */
    public $dataTableView = 'webed-core::admin._components.datatables.table';

    /**
     * @return CollectionDataTable|EloquentDataTable|QueryDataTable|mixed
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
            $this->fetch = do_filter(FRONT_FILTER_DATA_TABLES_FETCH, $this->fetchDataForAjax(), $this->screenName);
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
        $filters = do_filter(FRONT_FILTER_DATA_TABLES_FILTERS, $this->filters, $this->screenName);

        $headings = do_filter(FRONT_FILTER_DATA_TABLES_HEADINGS, $this->headings(), $this->screenName);

        $columns = json_encode(do_filter(FRONT_FILTER_DATA_TABLES_COLUMNS, $this->columns(), $this->screenName));

        $groupActions = do_filter(FRONT_FILTER_DATA_TABLES_GROUP_ACTIONS, $this->groupActions, $this->screenName);

        $selector = do_filter(FRONT_FILTER_DATA_TABLES_SELECTORS, $this->selector, $this->screenName);

        $ajaxUrl = do_filter(FRONT_FILTER_DATA_TABLES_AJAX_URL, $this->ajaxUrl, $this->screenName);

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
        if (!$this->fetch) {
            $this->fetch = do_filter(FRONT_FILTER_DATA_TABLES_FETCH, $this->fetchDataForAjax(), $this->screenName);
        }

        return $this->fetch->with($this->groupAction())->make(true, true);
    }

    /**
     * @return array
     */
    abstract public function headings(): array;

    /**
     * @return array
     */
    abstract public function columns(): array;

    /**
     * @return string
     */
    abstract public function run(): string;

    /**
     * @return CollectionDataTable|EloquentDataTable|QueryDataTable|mixed
     */
    abstract protected function fetchDataForAjax();

    /**
     * @return array
     */
    abstract protected function groupAction(): array;
}
