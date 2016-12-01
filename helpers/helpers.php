<?php

if (!function_exists('load_module_helpers')) {
    /**
     * @param $dir
     */
    function load_module_helpers($dir)
    {
        \WebEd\Base\Core\Support\Helper::loadModuleHelpers($dir);
    }
}

if (!function_exists('get_image')) {
    /**
     * @param $fields
     * @param $updateTo
     */
    function get_image($image, $default)
    {
        if (!$image || !trim($image)) {
            return $default;
        }
        return $image;
    }
}

if (!function_exists('convert_timestamp_format')) {
    /**
     * @param $dateTime
     * @param $format
     * @return string
     */
    function convert_timestamp_format($dateTime, $format = 'Y-m-d H:i:s')
    {
        if ($dateTime == '0000-00-00 00:00:00') {
            return null;
        }
        $date = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dateTime);
        return $date->format($format);
    }
}

if (!function_exists('convert_unix_time_format')) {
    /**
     * @param $dateTime
     * @param $format
     * @return string|null
     */
    function convert_unix_time_format($unix, $format = 'Y-m-d H:i:s')
    {
        try {
            return date($format, $unix);
        } catch (\Exception $exception) {
            return null;
        }
    }
}

if (!function_exists('json_encode_prettify')) {
    /**
     * @param array $files
     */
    function json_encode_prettify($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('is_in_dashboard')) {
    /**
     * @return bool
     */
    function is_in_dashboard()
    {
        $segment = request()->segment(1);
        if($segment === env('WEBED_ADMIN_ROUTE')) {
            return true;
        }

        return false;
    }
}
