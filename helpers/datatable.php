<?php

if (!function_exists('datatable')) {
    /**
     * @return \Yajra\Datatables\Datatables
     */
    function datatable()
    {
        return \Yajra\Datatables\Facades\Datatables::getFacadeRoot();
    }
}
