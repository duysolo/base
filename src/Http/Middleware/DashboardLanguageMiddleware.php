<?php namespace WebEd\Base\Http\Middleware;

use \Closure;
use WebEd\Base\Facades\DashboardLanguageFacade;

class DashboardLanguageMiddleware
{
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  array|string $params
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        $locale = DashboardLanguageFacade::getDashboardLanguage();
        app()->setLocale($locale);

        return $next($request);
    }
}
