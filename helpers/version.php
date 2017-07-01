<?php

if (!function_exists('get_composer_modules')) {
    /**
     * @param string $moduleName
     * @return \Illuminate\Support\Collection|array|null
     */
    function get_composer_modules($moduleName = null)
    {
        try {
            $composerLockFile = json_decode(get_file_data(base_path('composer.lock')), true);
            $packages = collect(array_get($composerLockFile, 'packages'));
            if ($moduleName) {
                return $packages->where('name', '=', $moduleName)->first();
            }
            return $packages;
        } catch (\Exception $exception) {
            return null;
        }
    }
}

if (!function_exists('get_core_module_composer_version')) {
    /**
     * @param string $moduleName
     * @return string
     */
    function get_core_module_composer_version($moduleName = null)
    {
        try {
            $module = get_composer_modules($moduleName);
            if (!$module) {
                return null;
            }
            return array_get($module, 'version');
        } catch (\Exception $exception) {
            return null;
        }
    }
}

if (!function_exists('get_core_module_version')) {
    /**
     * @param string $alias
     * @return string|null
     */
    function get_core_module_version($alias)
    {
        $module = get_core_module($alias);
        if ($module) {
            return array_get($module, 'version');
        }
        return null;
    }
}

if (!function_exists('get_cms_version')) {
    /**
     * @return string
     */
    function get_cms_version()
    {
        $coreModule = get_core_module('webed-core');
        return isset($coreModule['version']) ? $coreModule['version'] : get_core_module_composer_version('sgsoft-studio/base') ?: '3.1';
    }
}

if (!function_exists('module_version_compare')) {
    /**
     * @param $currentVersion
     * @param $condition
     * @return bool
     */
    function module_version_compare($currentVersion, $condition)
    {
        if (!$condition) {
            return true;
        }
        $where = substr($condition, 0, 1);
        switch ($where) {
            case '^':
                $operator = '>=';
                $condition = substr($condition, 1);
                break;
            case '~':
                $operator = '<=';
                $condition = substr($condition, 1);
                break;
            default:
                $operator = '==';
        }

        return version_compare($currentVersion, $condition, $operator);
    }
}

if (!function_exists('module_version_compare_with_message')) {
    /**
     * @param array $module
     * @param $condition
     * @return string
     */
    function module_version_compare_with_message($module, $condition)
    {
        if (!$condition) {
            return response_with_messages('Nothing to compare', true, Constants::ERROR_CODE);
        }
        $where = substr($condition, 0, 1);
        switch ($where) {
            case '^':
                $message = 'The module ' . array_get($module, 'alias') . ' version must higher or equal to ' . substr($condition, 1);
                break;
            case '~':
                $message = 'The module ' . array_get($module, 'alias') . ' version must lower or equal to ' . substr($condition, 1);
                break;
            default:
                $message = 'The module ' . array_get($module, 'alias') . ' version must equal to ' . $where;
        }

        $result = module_version_compare(array_get($module, 'installed_version', '0'), $condition);

        if (!$result) {
            return response_with_messages($message, true, Constants::ERROR_CODE);
        }
        return response_with_messages('Module version OK', false, Constants::SUCCESS_NO_CONTENT_CODE);
    }
}

if (!function_exists('check_module_require')) {
    /**
     * @param array $moduleNeedToCheck
     * @return array
     */
    function check_module_require(array $moduleNeedToCheck)
    {
        $required = array_get($moduleNeedToCheck, 'require', []) ?: [];
        $messages = [];
        $error = false;
        foreach ($required as $moduleName => $version) {
            $module = get_plugin($moduleName);
            if (!$module || !array_get($module, 'installed') || !array_get($module, 'enabled')) {
                $messages[] = 'Missing required module: ' . $moduleName;
                $error = true;
                continue;
            }

            $moduleVersionCompare = module_version_compare_with_message($module, $version);
            if ($moduleVersionCompare['error']) {
                $messages = array_merge($moduleVersionCompare['messages'], $messages);
                $error = true;
            }
        }
        return response_with_messages($messages, $error, $error ? Constants::ERROR_CODE : Constants::SUCCESS_NO_CONTENT_CODE);
    }
}
