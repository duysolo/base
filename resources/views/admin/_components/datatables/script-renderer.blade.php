<script>
    $(window).load(function () {
        WebEd.DataTableAjax.init($('{{ $selector }}'), {
            dataTableParams: {
                ajax: {
                    url: '{!! $ajaxUrl[0] or '' !!}',
                    method: '{!! $ajaxUrl[1] or 'GET' !!}'
                },
                columns: {!! $columns or '[]' !!}
            }
        });
    });
</script>
