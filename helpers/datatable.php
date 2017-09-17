<?php

if (!function_exists('webed_datatable')) {
    /**
     * @return \Yajra\DataTables\DataTables
     */
    function webed_datatable()
    {
        return \Yajra\DataTables\Facades\DataTables::getFacadeRoot();
    }
}
