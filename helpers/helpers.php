<?php

if (!function_exists('get_cms_version')) {
    /**
     * @return string
     */
    function get_cms_version()
    {
        try {
            $composerLockFile = json_decode(get_file_data(base_path('composer.lock')), true);
            $packages = collect(array_get($composerLockFile, 'packages'));
            return array_get($packages->where('name', '=', 'sgsoft-studio/base')->first(), 'version');
        } catch (\Exception $exception) {
            return '3.0';
        }
    }
}

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
    function get_image($image, $default = '/admin/images/no-image.png')
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
        if ($segment === config('webed.admin_route', 'admincp')) {
            return true;
        }

        return false;
    }
}

if (!function_exists('custom_strip_tags')) {
    /**
     * @param array|string $data
     * @param string $allowTags
     * @return array|string
     */
    function custom_strip_tags($data, $allowTags = '<p><a><br><b><strong>')
    {
        if (!is_array($data)) {
            return strip_tags($data, $allowTags);
        }
        foreach ($data as $key => $row) {
            $data[$key] = strip_tags($row, $allowTags);
        }
        return $data;
    }
}

if (!function_exists('limit_chars')) {
    /**
     * @param $string
     * @param null $limit
     * @param string $append
     * @param bool $hardCutString
     * @return string
     */
    function limit_chars($string, $limit = null, $append = '...', $hardCutString = false)
    {
        if (!$limit) {
            return $string;
        }
        if (mb_strlen($string) <= $limit) {
            $append = '';
        }
        if (!$hardCutString) {
            if (!$limit || $limit < 0) {
                return $string;
            }
            if (mb_strlen($string) <= $limit) {
                $append = '';
            }

            $string = mb_substr($string, 0, $limit);
            if (mb_substr($string, -1, 1) != ' ') {
                $string = mb_substr($string, 0, mb_strrpos($string, ' '));
            }

            return $string . $append;
        }
        return mb_substr($string, 0, $limit) . $append;
    }
}
