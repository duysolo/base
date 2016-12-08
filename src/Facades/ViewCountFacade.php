<?php namespace WebEd\Base\Core\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Core\Support\ViewCount;

class ViewCountFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ViewCount::class;
    }
}
