<?php namespace WebEd\Base\ServerActions;

abstract class AbstractServerAction
{
    /**
     * @param $message
     * @param array|null $data
     * @return array
     */
    protected function error($message, array $data = null)
    {
        return response_with_messages($message, true, \Constants::ERROR_CODE, $data);
    }

    /**
     * @param $message
     * @param array|null $data
     * @return array
     */
    protected function success($message, array $data = null)
    {
        return response_with_messages(
            $message,
            false,
            $data === null ? \Constants::SUCCESS_NO_CONTENT_CODE : \Constants::SUCCESS_CODE,
            $data
        );
    }
}
