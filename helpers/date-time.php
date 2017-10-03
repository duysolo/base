<?php

use Carbon\Carbon;

if (!function_exists('format_date')) {
    /**
     * @param string $time
     * @param string $format
     * @return mixed
     */
    function format_date($time, $format = 'Y-m-d')
    {
        if ($time instanceof Carbon) {
            $dateTime = $time;
        } else {
            $dateTime = Carbon::parse($time);
        }

        return $dateTime->format($format);
    }
}
