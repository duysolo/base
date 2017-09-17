<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <title>{{ $pageTitle or '' }} - {{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {!! seo()->render() !!}

    <script>
        var BASE_URL = '{{ asset('') }}';
    </script>

    <base href="{{ asset('') }}">
    <meta name="google-site-verification" content="{{ get_theme_option('google_site_verification') }}"/>

    <link rel="stylesheet" href="{{ asset('themes/news-tv/dist/style.css') }}">

    @foreach(config('sgsoft-themes.' . (get_theme_option('theme_layout', 'red') ?: 'red') . '.css') as $css)
        <link rel="stylesheet" href="{{ asset($css) }}">
    @endforeach

    <link id="style_color" rel="stylesheet">

    @php do_action('front_header_css') @endphp

    @yield('css')

    @stack('css')

    @php do_action('front_header_js') @endphp
</head>

<body class="{{ $bodyClass or '' }} @php do_action('front_body_class') @endphp">
<input type="checkbox" class="hidden" id="menu_visible_trigger">

<div class="wrapper" id="site_wrapper">
    @php do_action('front_before_header_wrapper_content') @endphp

    <header class="header" id="header">
        @include('webed-theme::front._partials.header')
    </header>

    @include('webed-theme::front._partials.flash-messages')

    @php do_action('front_before_main_wrapper_content') @endphp

    <main class="main" id="main">
        @yield('content')
    </main>

    @php do_action('front_before_footer_wrapper_content') @endphp

    <footer class="footer" id="footer">
        @include('webed-theme::front._partials.footer')
    </footer>

    @php do_action('front_bottom_wrapper_content') @endphp
</div>

@php do_action('front_bottom_content') @endphp

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

@php do_action('front_footer_js') @endphp
<script src="{{ asset('themes/news-tv/third_party/modernizr.js') }}"></script>
<script type="text/javascript"
        src="//platform-api.sharethis.com/js/sharethis.js#property=58b80e5cfacf57001271be31&product=sticky-share-buttons"></script>

<script src="{{ asset('themes/news-tv/dist/core.min.js') }}"></script>
<script src="{{ asset('themes/news-tv/dist/app.min.js') }}"></script>

@php do_action('front_footer_js') @endphp

@yield('js')

@stack('js')

@yield('js-init')

@stack('js-init')

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=867766230033521";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</body>

</html>
