<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Support\AdminQuickLink;

class AdminQuickLinkFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdminQuickLink::class;
    }
}
