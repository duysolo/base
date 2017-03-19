<?php namespace WebEd\Base\Facades;

use Illuminate\Support\Facades\Facade;
use WebEd\Base\Support\SEO;
use WebEd\Base\Support\ViewCount;

class SeoFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return SEO::class;
    }
}
