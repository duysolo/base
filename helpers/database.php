<?php

if (!function_exists('check_db_connection')) {
    /**
     * @return bool
     */
    function check_db_connection()
    {
        try {
            DB::connection()->reconnect();
            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}

if (!function_exists('esc_sql')) {
    /**
     * @param $string
     * @return string
     */
    function esc_sql($string)
    {
        return app('db')->getPdo()->quote($string);
    }
}

if (!function_exists('webed_db_prefix')) {
    /**
     * @return string
     */
    function webed_db_prefix()
    {
        return WEBED_DB_PREFIX;
    }
}
