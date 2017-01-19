<?php

if (!function_exists('response_with_messages')) {
    /**
     * @param string|array $messages
     * @param bool $error
     * @param int $responseCode
     * @param array $data
     * @return array
     */
    function response_with_messages($messages, $error = false, $responseCode = null, $data = null)
    {
        return [
            'error' => $error,
            'response_code' => $responseCode ?: Constants::SUCCESS_NO_CONTENT_CODE,
            'messages' => (array)$messages,
            'data' => $data
        ];
    }
}

if (!function_exists('flash_messages')) {
    /**
     * @return \WebEd\Base\Core\Services\FlashMessages
     */
    function flash_messages()
    {
        return \WebEd\Base\Core\Facades\FlashMessagesFacade::getFacadeRoot();
    }
}
