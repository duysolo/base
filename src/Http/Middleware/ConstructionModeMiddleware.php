<?php namespace WebEd\Base\Http\Middleware;

use \Closure;

class ConstructionModeMiddleware
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
        if (!!(int)get_setting('construction_mode')) {
            if (!$request->user() || !$request->user()->hasPermission('access-dashboard')) {
                abort(\Constants::MAINTENANCE_MODE);
            }
        }

        return $next($request);
    }
}
