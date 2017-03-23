<?php

if (!function_exists('lang')) {
    /**
     * @return \Illuminate\Translation\Translator
     */
    function lang()
    {
        return \Illuminate\Support\Facades\Lang::getFacadeRoot();
    }
}