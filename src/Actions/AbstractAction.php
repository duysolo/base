<?php namespace WebEd\Base\Actions;

abstract class AbstractAction
{
    protected function error($message, array $data = null)
    {
        return response_with_messages($message, true, \Constants::ERROR_CODE, $data);
    }

    protected function success($message, array $data = null)
    {
        return response_with_messages($message, false, \Constants::SUCCESS_CODE, $data);
    }
}
