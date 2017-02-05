WebEd.ckeditor = function ($elements, config) {
    config = $.extend(true, {
        filebrowserBrowseUrl: FILE_MANAGER_URL + '?method=ckeditor',
        extraPlugins: 'codeTag,insertpre',
        allowedContent: true,
        height: '400px'
    }, config);
    $elements.ckeditor($.noop, config);
};
