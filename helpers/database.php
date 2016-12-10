<?php

if (!function_exists('check_db_connection')) {
    /**
     * @return bool
     */
    function check_db_connection()
    {
        try {
            \DB::connection()->reconnect();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
