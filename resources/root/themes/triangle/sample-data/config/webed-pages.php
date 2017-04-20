<?php

return [
    /**
     * Public routes
     */
    'public_routes' => [
        'web' => [
            'get' => [
                [
                    '/search',
                    [
                        'as' => 'front.search.get',
                        'uses' => \WebEd\Themes\Triangle\Http\Controllers\Pages\SearchController::class . '@handle',
                    ]
                ],
                [
                    '/{slug?}',
                    [
                        'as' => 'front.web.resolve-pages.get',
                        'uses' => 'WebEd\Base\Pages\Http\Controllers\Front\ResolvePagesController@handle',
                        'where' => [
                            'slug' => '[-A-Za-z0-9]+'
                        ]
                    ]
                ]
            ],
        ],
        'api' => [

        ],
    ],
    /**
     * Custom route location
     * You can pass the files directory here
     * Example: web => [base_path(aaa.php), base_path(xxx.php)]
     */
    'custom_route_locations' => [
        'web' => [

        ],
        'api' => [

        ],
    ]
];
