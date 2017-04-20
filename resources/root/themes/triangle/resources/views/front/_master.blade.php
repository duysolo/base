<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <base href="{{ asset('') }}">

    <title>{{ $pageTitle or '' }} - {{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {!! seo()->render() !!}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="themes/triangle/css/bootstrap.min.css" rel="stylesheet">
    <link href="themes/triangle/css/font-awesome.min.css" rel="stylesheet">
    <link href="themes/triangle/css/animate.min.css" rel="stylesheet">
    <link href="themes/triangle/css/lightbox.css" rel="stylesheet">
    <link href="themes/triangle/css/main.css" rel="stylesheet">
    <link href="themes/triangle/css/responsive.css" rel="stylesheet">

    @php do_action('front_header_css') @endphp

    @yield('css')

    @php do_action('front_header_js') @endphp
</head>

<body class="{{ $bodyClass or '' }} @php do_action('front_body_class') @endphp">

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

<script type="text/javascript" src="themes/triangle/js/jquery.js"></script>
<script type="text/javascript" src="themes/triangle/js/bootstrap.min.js"></script>
<script type="text/javascript" src="themes/triangle/js/lightbox.min.js"></script>
<script type="text/javascript" src="themes/triangle/js/wow.min.js"></script>
<script type="text/javascript" src="themes/triangle/js/main.js"></script>

@php do_action('front_footer_js') @endphp

@yield('js')

@yield('js-init')

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
