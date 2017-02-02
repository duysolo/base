<?php namespace WebEd\Base\Core\Exceptions;

use App\Exceptions\Handler as ExceptionHandler;
use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|array
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
            /**
             * @var HttpException $exception
             */
            switch ($exception->getStatusCode()) {
                /**
                 * 401
                 */
                case \Constants::UNAUTHORIZED_CODE:
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(response_with_messages('Access denied', true, \Constants::UNAUTHORIZED_CODE));
                    }
                    if (is_in_dashboard()) {
                        return response()->view('webed-core::admin.errors.' . \Constants::UNAUTHORIZED_CODE, [], \Constants::UNAUTHORIZED_CODE);
                    }
                    return response()->view('webed-theme::front.errors.' . \Constants::UNAUTHORIZED_CODE, [], \Constants::UNAUTHORIZED_CODE);
                    break;
                /**
                 * 403
                 */
                case \Constants::FORBIDDEN_CODE:
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(response_with_messages('You do not have permission to access these resources', true, \Constants::FORBIDDEN_CODE));
                    }
                    if (is_in_dashboard()) {
                        return response()->view('webed-core::admin.errors.' . \Constants::FORBIDDEN_CODE, [], \Constants::FORBIDDEN_CODE);
                    }
                    return response()->view('webed-theme::front.errors.' . \Constants::FORBIDDEN_CODE, [], \Constants::FORBIDDEN_CODE);
                    break;
                /**
                 * 404
                 */
                case \Constants::NOT_FOUND_CODE:
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(response_with_messages('Page not found', true, \Constants::NOT_FOUND_CODE));
                    }
                    if (is_in_dashboard()) {
                        return response()->view('webed-core::admin.errors.' . \Constants::NOT_FOUND_CODE, [], \Constants::NOT_FOUND_CODE);
                    }
                    return response()->view('webed-theme::front.errors.' . \Constants::NOT_FOUND_CODE, [], \Constants::NOT_FOUND_CODE);
                    break;
                /**
                 * 500
                 */
                case \Constants::ERROR_CODE:
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(response_with_messages($exception->getMessage(), true, \Constants::ERROR_CODE));
                    }
                    if (is_in_dashboard()) {
                        return response()->view('webed-core::admin.errors.' . \Constants::ERROR_CODE, [
                            'exception' => $exception
                        ], \Constants::ERROR_CODE);
                    }
                    return response()->view('webed-theme::front.errors.' . \Constants::ERROR_CODE, [
                        'exception' => $exception
                    ], \Constants::ERROR_CODE);
                    break;
                /**
                 * 503
                 */
                case \Constants::MAINTENANCE_MODE:
                    if ($request->ajax() || $request->wantsJson()) {
                        return response()->json(response_with_messages('We are one maintenance mode', true, \Constants::MAINTENANCE_MODE));
                    }
                    if (is_in_dashboard()) {
                        return response()->view('webed-core::admin.errors.' . \Constants::MAINTENANCE_MODE, [], \Constants::MAINTENANCE_MODE);
                    }
                    return response()->view('webed-theme::front.errors.' . \Constants::MAINTENANCE_MODE, [], \Constants::MAINTENANCE_MODE);
                    break;
            }
        }

        return parent::render($request, $exception);
    }
}
