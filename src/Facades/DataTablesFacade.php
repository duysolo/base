<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Support\DataTable\DataTables;

class DataTablesFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return DataTables::class;
    }
}
