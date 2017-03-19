<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Support\AdminBar;

class AdminBarFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdminBar::class;
    }
}
