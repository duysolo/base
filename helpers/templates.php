<?php

if (!function_exists('get_templates')) {
    /**
     * @param string $type
     * @return array
     */
    function get_templates($type = null)
    {
        $types = config('webed-templates');
        if ($type === null) {
            return $types;
        }

        $templates = array_get($types, $type, []);
        return $templates ?: [];
    }
}

if (!function_exists('add_new_template')) {
    /**
     * @param array $template
     * @param string $type
     */
    function add_new_template(array $template, $type)
    {
        $types = config('webed-templates');

        $currentTemplates = array_get($types, $type, []);

        $types[$type] = array_merge($currentTemplates, $template);

        config([
            'webed-templates' => $types,
        ]);
    }
}
