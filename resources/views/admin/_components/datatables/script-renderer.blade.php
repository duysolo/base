<script>
    $(window).load(function () {
        new WebEd.DataTableAjax($('{{ $selector }}'), {
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
