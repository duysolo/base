<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Services\FlashMessages;

class FlashMessagesFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return FlashMessages::class;
    }
}
