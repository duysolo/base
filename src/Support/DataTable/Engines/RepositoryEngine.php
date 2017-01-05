<?php namespace WebEd\Base\Core\Support\DataTable\Engines;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use WebEd\Base\Core\Repositories\AbstractBaseRepository;
use WebEd\Base\Caching\Repositories\AbstractRepositoryCacheDecorator;
use Yajra\Datatables\Engines\BaseEngine;
use Yajra\Datatables\Request;
use Closure;

class RepositoryEngine extends BaseEngine
{
    /**
     * @var AbstractBaseRepository|AbstractRepositoryCacheDecorator
     */
    protected $repository;

    /**
     * @var Collection|LengthAwarePaginator
     */
    protected $results;

    public function __construct($repository, Request $request)
    {
        if ($repository instanceof AbstractRepositoryCacheDecorator || $repository instanceof AbstractBaseRepository) {
            $this->repository = $repository;
        } else {
            throw new \RuntimeException('Repository must be a instance of ' . AbstractBaseRepository::class . ' or ' . AbstractRepositoryCacheDecorator::class);
        }

        $this->request = $request;
        $this->columns = array_get($this->repository->getQueryBuilderData(), 'select', []);
        $this->connection = $this->repository->getModel()->getConnection();

        $this->query = $repository;
        $this->query_type = 'repository';
    }

    /**
     * Get Query Builder object.
     *
     * @param mixed $instance
     * @return mixed
     */
    public function getQueryBuilder($instance = null)
    {
        return $this->repository;
    }

    public function columnSearch()
    {
        $columns = $this->request->get('columns', []);

        foreach ($columns as $index => $column) {
            if (!$this->request->isColumnSearchable($index)) {
                continue;
            }

            $column = $this->getColumnName($index);
            $keyword = $this->getSearchKeyword($index);

            if (isset($this->columnDef['filter'][$column])) {
                $columnDef = $this->columnDef['filter'][$column];

                if ($columnDef['method'] instanceof Closure) {
                    $this->repository = $this->query = call_user_func_array($columnDef['method'], [$this->repository, $keyword]);
                } else {
                    if ($keyword) {
                        $this->repository = $this->repository->where($column, 'LIKE', $keyword);
                    }
                }
            } else {
                if ($keyword) {
                    $this->repository = $this->repository->where($column, 'LIKE', $keyword);
                }
            }

            $this->isFilterApplied = true;
        }
    }

    public function filtering()
    {
        $globalKeyword = $this->request->keyword();
        foreach ($this->request->searchableColumnIndex() as $index) {
            $columnName = $this->getColumnName($index);
            if ($this->isBlacklisted($columnName)) {
                continue;
            }
            $keyword = $this->request->get('columns[' . $index . '][search][value]');

            $this->repository = $this->repository->where(function ($q) use ($columnName, $keyword, $globalKeyword) {
                $q
                    ->where($columnName, 'LIKE', $keyword)
                    ->orWhere($columnName, 'LIKE', $globalKeyword);
            });
        }

        $this->isFilterApplied = true;
    }

    public function ordering()
    {
        foreach ($this->request->orderableColumns() as $orderable) {
            $column = $this->getColumnName($orderable['column'], true);

            if ($this->isBlacklisted($column)) {
                continue;
            }

            $this->repository->orderBy($column, $orderable['direction']);
        }
    }

    public function paging()
    {
        $this->repository->skip($this->request['start'])
            ->take((int)$this->request['length'] > 0 ? $this->request['length'] : 10);
    }

    public function filter(Closure $callback, $globalSearch = false)
    {
        $this->overrideGlobalSearch($callback, $this->repository, $globalSearch);
        return $this;
    }

    public function count()
    {
        $repository = clone $this->repository;

        $repository = $repository->get();

        try {
            return $repository->total();
        } catch (\Exception $exception) {
            return $repository->count();
        }
    }

    public function totalCount()
    {
        return $this->count();
    }

    public function results()
    {
        return $this->repository->get();
    }

    /**
     * Get proper keyword to use for search.
     * @param int $i
     * @return string
     */
    private function getSearchKeyword($i)
    {
        $keyword = $this->request->columnKeyword($i);

        return $keyword;
    }
}
