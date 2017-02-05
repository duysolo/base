<?php

if (!function_exists('get_templates')) {
    /**
     * @param string $type
     * @return array
     */
    function get_templates($type = null)
    {
        if ($type === null) {
            return config('webed-templates');
        }
        $templates = config('webed-templates.' . $type, []);
        return $templates;
    }
}

if (!function_exists('add_new_template')) {
    /**
     * @param array $template
     * @param string $type
     */
    function add_new_template(array $template, $type)
    {
        $currentTemplates = config('webed-templates.' . $type, []);
        config(['webed-templates.' . $type => array_merge($currentTemplates, $template)]);
    }
}
