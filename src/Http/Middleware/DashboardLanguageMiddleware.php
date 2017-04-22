<?php namespace WebEd\Base\Http\Middleware;

use \Closure;
use WebEd\Base\Facades\DashboardLanguageFacade;

class DashboardLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = DashboardLanguageFacade::getDashboardLanguage();
        app()->setLocale($locale);

        return $next($request);
    }
}
