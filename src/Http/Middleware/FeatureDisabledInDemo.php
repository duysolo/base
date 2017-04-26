<?php namespace WebEd\Base\Http\Middleware;

use \Closure;

class FeatureDisabledInDemo
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
        if (app()->environment() == 'demo') {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(response_with_messages(trans('webed-core::base.disabled_in_demo_mode'), 'error', \Constants::ERROR_CODE));
            }
            flash_messages()
                ->addMessages(trans('webed-core::base.disabled_in_demo_mode'), 'danger')
                ->showMessagesOnSession();
            return redirect()->back();
        }

        return $next($request);
    }
}
