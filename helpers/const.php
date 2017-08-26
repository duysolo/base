<?php

if (!defined('WEBED_DB_PREFIX')) {
    define('WEBED_DB_PREFIX', 'we_');
}

/**
 * Filters routes
 */
if (!defined('BASE_FILTER_PUBLIC_ROUTE')) {
    define('BASE_FILTER_PUBLIC_ROUTE', 'webed.hook-filter.public-route');
}

/**
 * Filters when update data
 */
if (!defined('BASE_FILTER_BEFORE_UPDATE')) {
    define('BASE_FILTER_BEFORE_UPDATE', 'webed.hook-filter.before-update');
}

if (!defined('BASE_FILTER_BEFORE_DELETE')) {
    define('BASE_FILTER_BEFORE_DELETE', 'webed.hook-filter.before-delete');
}

if (!defined('BASE_FILTER_BEFORE_FORCE_DELETE')) {
    define('BASE_FILTER_BEFORE_FORCE_DELETE', 'webed.hook-filter.before-force-delete');
}

if (!defined('BASE_FILTER_BEFORE_RESTORE')) {
    define('BASE_FILTER_BEFORE_RESTORE', 'webed.hook-filter.before-restore');
}

/**
 * Actions when update data
 */
if (!defined('BASE_ACTION_BEFORE_CREATE')) {
    define('BASE_ACTION_BEFORE_CREATE', 'webed.hook-action.before-create');
}

if (!defined('BASE_ACTION_AFTER_CREATE')) {
    define('BASE_ACTION_AFTER_CREATE', 'webed.hook-action.after-create');
}

if (!defined('BASE_ACTION_AFTER_UPDATE')) {
    define('BASE_ACTION_AFTER_UPDATE', 'webed.hook-action.after-update');
}

if (!defined('BASE_ACTION_AFTER_DELETE')) {
    define('BASE_ACTION_AFTER_DELETE', 'webed.hook-action.after-delete');
}

if (!defined('BASE_ACTION_AFTER_FORCE_DELETE')) {
    define('BASE_ACTION_AFTER_FORCE_DELETE', 'webed.hook-action.after-force-delete');
}

if (!defined('BASE_ACTION_AFTER_RESTORE')) {
    define('BASE_ACTION_AFTER_RESTORE', 'webed.hook-action.after-restore');
}

/**
 * Actions in views
 */
if (!defined('BASE_ACTION_FORM_ACTIONS')) {
    define('BASE_ACTION_FORM_ACTIONS', 'base_action_form_actions');
}

if (!defined('BASE_ACTION_HEADER_MENU')) {
    define('BASE_ACTION_HEADER_MENU', 'base_action_header_menu');
}

if (!defined('BASE_ACTION_HEADER_CSS')) {
    define('BASE_ACTION_HEADER_CSS', 'header_css');
}

if (!defined('BASE_ACTION_HEADER_JS')) {
    define('BASE_ACTION_HEADER_JS', 'header_js');
}

if (!defined('BASE_ACTION_BODY_CLASS')) {
    define('BASE_ACTION_BODY_CLASS', 'body_class');
}

if (!defined('BASE_ACTION_FOOTER_JS')) {
    define('BASE_ACTION_FOOTER_JS', 'footer_js');
}

if (!defined('BASE_ACTION_FLASH_MESSAGES')) {
    define('BASE_ACTION_FLASH_MESSAGES', 'flash_messages');
}

if (!defined('BASE_ACTION_META_BOXES')) {
    define('BASE_ACTION_META_BOXES', 'meta_boxes');
}

/**
 * Filter controller
 */
if (!defined('BASE_FILTER_CONTROLLER')) {
    define('BASE_FILTER_CONTROLLER', 'base.filter-controller');
}
if (!defined('FRONT_FILTER_FIND_DATA')) {
    define('FRONT_FILTER_FIND_DATA', 'base.front.filter-find-data');
}

/**
 * Filter Data Tables
 */
if (!defined('FRONT_FILTER_DATA_TABLES')) {
    define('FRONT_FILTER_DATA_TABLES', 'base.filter-data-tables');
}
if (!defined('FRONT_FILTER_DATA_TABLES_MODEL')) {
    define('FRONT_FILTER_DATA_TABLES_MODEL', 'base.filter-data-tables.model');
}
if (!defined('FRONT_FILTER_DATA_TABLES_HEADINGS')) {
    define('FRONT_FILTER_DATA_TABLES_HEADINGS', 'base.filter-data-tables.headings');
}
if (!defined('FRONT_FILTER_DATA_TABLES_COLUMNS')) {
    define('FRONT_FILTER_DATA_TABLES_COLUMNS', 'base.filter-data-tables.columns');
}
if (!defined('FRONT_FILTER_DATA_TABLES_FILTERS')) {
    define('FRONT_FILTER_DATA_TABLES_FILTERS', 'base.filter-data-tables.filters');
}
if (!defined('FRONT_FILTER_DATA_TABLES_FETCH')) {
    define('FRONT_FILTER_DATA_TABLES_FETCH', 'base.filter-data-tables.fetch');
}
if (!defined('FRONT_FILTER_DATA_TABLES_GROUP_ACTIONS')) {
    define('FRONT_FILTER_DATA_TABLES_GROUP_ACTIONS', 'base.filter-data-tables.group-actions');
}
if (!defined('FRONT_FILTER_DATA_TABLES_SELECTORS')) {
    define('FRONT_FILTER_DATA_TABLES_SELECTORS', 'base.filter-data-tables.selectors');
}
if (!defined('FRONT_FILTER_DATA_TABLES_AJAX_URL')) {
    define('FRONT_FILTER_DATA_TABLES_AJAX_URL', 'base.filter-data-tables.ajax-url');
}

/**
 * Dashboard statistics
 */
if (!defined('WEBED_DASHBOARD_STATS')) {
    define('WEBED_DASHBOARD_STATS', 'webed-dashboard.index.stat-boxes');
}

if (!defined('WEBED_DASHBOARD_OTHERS')) {
    define('WEBED_DASHBOARD_OTHERS', 'webed-dashboard.index.other');
}


class Constants
{
    const SUCCESS_CODE = 201;

    const SUCCESS_NO_CONTENT_CODE = 200;

    const UNAUTHORIZED_CODE = 401;

    const FORBIDDEN_CODE = 403;

    const NOT_FOUND_CODE = 404;

    const METHOD_NOT_ALLOWED = 405;

    const ERROR_CODE = 500;

    const MAINTENANCE_MODE = 503;
}
