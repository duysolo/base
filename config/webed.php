<?php

/**
 * Global config for WebEd
 * @author Tedozi Manson <duyphan.developer@gmail.com>
 */
return [
    /**
     * Admin route slug
     */
    'admin_route' => env('WEBED_ADMIN_ROUTE', 'admincp'),

    'api_route' => env('WEBED_API_ROUTE', 'api'),

    'languages' => [
        'vi' => 'Vietnamese',
        'en' => 'English'
    ],

    'external_core' => [
        WebEd\Base\Elfinder\Providers\ModuleProvider::class,
        WebEd\Base\Pages\Providers\ModuleProvider::class,
        WebEd\Base\StaticBlocks\Providers\ModuleProvider::class,
    ],

    'exception_handler' => \WebEd\Base\Exceptions\Handler::class,
];
