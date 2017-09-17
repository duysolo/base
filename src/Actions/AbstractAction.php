<?php namespace WebEd\Base\Actions;

abstract class AbstractAction
{
    /**
     * @param $message
     * @param array|null $data
     * @return array
     */
    protected function error($message = null, array $data = null): array
    {
        if (!$message) {
            $message = trans('webed-core::base.form.error_occurred');
        }

        return response_with_messages($message, true, \Constants::ERROR_CODE, $data);
    }

    /**
     * @param $message
     * @param array|null $data
     * @return array
     */
    protected function success($message = null, array $data = null): array
    {
        if (!$message) {
            $message = trans('webed-core::base.form.request_completed');
        }

        return response_with_messages(
            $message,
            false,
            !$data ? \Constants::SUCCESS_NO_CONTENT_CODE : \Constants::SUCCESS_CODE,
            $data
        );
    }
}
