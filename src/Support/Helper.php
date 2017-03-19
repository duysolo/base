<?php namespace WebEd\Base\Support;

class Helper {
    /**
     * @param $dir
     */
    public static function loadModuleHelpers($dir)
    {
        $helpers = \File::glob($dir . '/../../helpers/*.php');
        foreach ($helpers as $helper) {
            require_once $helper;
        }
    }
}
