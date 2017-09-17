<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;

class BreadcrumbsFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return \WebEd\Base\Support\Breadcrumbs::class;
    }
}
