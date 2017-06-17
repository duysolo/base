<?php

use \Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('pagination_advanced')) {
    /**
     * @param LengthAwarePaginator $paginator
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function pagination_advanced(LengthAwarePaginatorContract $paginator, array $params = [])
    {
        $params = array_merge([
            'limit' => 7,
            'allowed_query_string' => request()->only(['page']),
            'wrapper_tag' => 'nav',
            'group_tag' => 'ul',
            'item_tag' => 'li',
            'wrapper_class' => 'pagination-wrap',
            'group_class' => 'pagination',
            'item_class' => '',
            'disabled_class' => 'disabled',
            'activated_class' => 'active',
            'go_first_title' => '&laquo;',
            'go_prev_title' => '&lsaquo;',
            'go_next_title' => '&rsaquo;',
            'go_last_title' => '&raquo;',
            'view' => 'webed-core::front._components.pagination',
        ], $params);

        $paginator->appends($params['allowed_query_string']);

        return view($params['view'], [
            'limit' => $params['limit'],
            'paginator' => $paginator,
            'wrapperTag' => $params['wrapper_tag'],
            'groupTag' => $params['group_tag'],
            'itemTag' => $params['item_tag'],
            'wrapperClass' => $params['wrapper_class'],
            'groupClass' => $params['group_class'],
            'itemClass' => $params['item_class'],
            'disabledClass' => $params['disabled_class'],
            'activatedClass' => $params['activated_class'],
            'goFirstTitle' => $params['go_first_title'],
            'goPrevTitle' => $params['go_prev_title'],
            'goNextTitle' => $params['go_next_title'],
            'goLastTitle' => $params['go_last_title'],
        ]);
    }
}
