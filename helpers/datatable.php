<?php

if (!function_exists('datatable')) {
    /**
     * @return \WebEd\Base\Core\Support\DataTable\DataTables
     */
    function datatable()
    {
        return app(\WebEd\Base\Core\Support\DataTable\DataTables::class);
    }
}
