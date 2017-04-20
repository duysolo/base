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
        $dateTime = Carbon::parse($time);

        $first = Carbon::create(0000, 0, 0, 00, 00, 00);
        if ($time->lte($first)) {
            return '';
        }

        return $dateTime->format($format);
    }
}