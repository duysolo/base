<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;

class BreadcrumbsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \WebEd\Base\Support\Breadcrumbs::class;
    }
}
