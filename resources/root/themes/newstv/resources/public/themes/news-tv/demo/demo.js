/**
 Demo script to handle the theme demo
 **/

var Layout = {
    base: './',
    html: './',
    temp: './.tmp',
    dist: './dist',
    coreThirdParty: './third_party',
    bower: 'bower_components',
    npm: 'node_modules',
    css: 'css',
    js: 'js',
    images: 'images',
    demo: 'demo',
};

var Demo = function () {

    // Handle Theme Settings
    var handleTheme = function () {

        var panel = $('.theme-panel');

        // handle theme colors
        var setColor = function (color) {
            if (color) {
                localStorage.setItem('theme_color', color);
            }
            if (localStorage.getItem('theme_color')) {
                $('#style_color').attr('href', Layout.dist + '/themes/' + localStorage.getItem('theme_color') + '.css');
                // $('.logo img').attr('src', Layout.demo + '/logo' + color +'.png');
            }
        };

        $('.theme-colors > ul > li > a', panel).click(function () {
            var color = $(this).attr('data-style');
            setColor(color);
            $('ul > li > a', panel).removeClass('current');
            $(this).addClass('current');
        });

        $('.theme-panel-control').click(function () {
            $(this).parents('.theme-panel-wrap').toggleClass('active');
        });

        setColor(null);
    };

    return {

        //main function to initiate the theme
        init: function () {
            // handles style customer tool
            handleTheme();
        }
    };

}();

jQuery(document).ready(function () {
    Demo.init(); // init theme core componets
});
