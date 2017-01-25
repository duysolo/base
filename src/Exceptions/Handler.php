<?php namespace WebEd\Base\Core\Exceptions;

use App\Exceptions\Handler as ExceptionHandler;
use Exception;
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
                case 401:
                    if (is_in_dashboard()) {
                        if ($request->ajax() || $request->wantsJson()) {
                            return response_with_messages('Access denied', true, 401);
                        } else {
                            return response()->view('webed-core::admin.errors.401', [], 401);
                        }
                    }
                    break;
                case 404:
                    if (is_in_dashboard()) {
                        if ($request->ajax() || $request->wantsJson()) {
                            return response_with_messages('Page not found', true, 404);
                        } else {
                            return response()->view('webed-core::admin.errors.404', [], 404);
                        }
                    }
                    break;
            }
        }

        return parent::render($request, $exception);
    }
}