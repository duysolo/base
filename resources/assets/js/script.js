$(document).ready(function(){
    /**
     * Detect IE
     */
    WebEd.isIE(function(){
        /**
         * Callback
         */
    });

    /**
     * Add csrf token to ajax request
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    /**
     * Handle select media box
     */
    WebEd.handleSelectMediaBox();

    WebEd.tabChangeUrl();

    /**
     * Init layout
     */
    WebEd.initAjax();

    WebEd.fixedTopFormActions();
});

$(window).load(function () {
    WebEd.hideLoading();
});
