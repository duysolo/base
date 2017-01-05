<?php namespace WebEd\Base\Core\Support\DataTable;

use WebEd\Base\Core\Repositories\AbstractBaseRepository;
use WebEd\Base\Caching\Repositories\AbstractRepositoryCacheDecorator;
use WebEd\Base\Core\Support\DataTable\Engines\RepositoryEngine;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Collection;

class DataTables extends \Yajra\Datatables\Datatables
{
    /**
     * Datatables request object.
     *
     * @var \Yajra\Datatables\Request
     */
    public $request;

    /**
     * Datatables builder.
     *
     * @var mixed
     */
    public $builder;

    /**
     * Gets query and returns instance of class.
     *
     * @param  mixed $builder
     * @return mixed
     */
    public static function of($builder)
    {
        $datatables = app(DataTables::class);
        $datatables->builder = $builder;

        if ($builder instanceof AbstractBaseRepository || $builder instanceof AbstractRepositoryCacheDecorator) {
            $ins = $datatables->usingRepository($builder);
        } else {
            if ($builder instanceof QueryBuilder) {
                $ins = $datatables->usingQueryBuilder($builder);
            } else {
                $ins = $builder instanceof Collection ? $datatables->usingCollection($builder) : $datatables->usingEloquent($builder);
            }
        }

        return $ins;
    }

    /**
     * Datatables using Repository
     * @param mixed $builder
     * @return RepositoryEngine
     */
    public function usingRepository($builder)
    {
        return new RepositoryEngine($builder, $this->request);
    }
}
