<?php namespace WebEd\Themes\Triangle\Http\Middleware;

use \Closure;

class BootstrapModuleMiddleware
{
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->registerSettings();

        return $next($request);
    }

    protected function registerSettings()
    {
        cms_theme_options()
            ->addOptionField('footer_content_page', [
                'group' => 'basic',
                'type' => 'select',
                'priority' => 0,
                'label' => 'Footer content page',
                'helper' => 'This page will store the footer content',
            ], function () {
                $pages = get_pages([
                    'select' => [
                        'id', 'title'
                    ],
                    /*Ignore the filters*/
                    'condition' => [],
                    'order_by' => [
                        'order' => 'ASC',
                        'created_at' => 'DESC',
                    ],
                ])
                    ->pluck('title', 'id')
                    ->toArray();

                return [
                    'footer_content_page',
                    $pages,
                    get_theme_option('footer_content_page'),
                    ['class' => 'form-control']
                ];
            })
            ->addOptionField('items_per_page', [
                'group' => 'basic',
                'type' => 'number',
                'priority' => 0,
                'label' => 'Items per page',
                'helper' => 'How many items will be shown on each paginated page?'
            ], function () {
                return [
                    'items_per_page',
                    get_theme_option('items_per_page'),
                    ['class' => 'form-control']
                ];
            });
    }
}
