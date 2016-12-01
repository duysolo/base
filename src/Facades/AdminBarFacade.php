<?php namespace WebEd\Base\Core\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Core\Support\AdminBar;

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
