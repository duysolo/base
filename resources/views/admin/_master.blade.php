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

    <meta charset="utf-8"/>
    <title>{{ $pageTitle or 'Dashboard' }} | {{ config('app.name', 'WebEd') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="{{ config('app.name', 'WebEd') }}" name="description"/>

    {!! assets_management()->renderStylesheets() !!}

    @php do_action(BASE_ACTION_HEADER_CSS) @endphp

    <link rel="stylesheet" href="{{ asset('admin/theme/lte/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/theme/lte/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <link rel="shortcut icon" href="{{ get_setting('favicon', 'favicon.png') }}"/>

    {!! assets_management()->renderScripts('top') !!}

    @stack('head')

    @yield('head')

    <script type="text/javascript">
        var BASE_URL = '{{ asset('') }}';
    </script>

    @php do_action(BASE_ACTION_HEADER_JS) @endphp
</head>

<body class="{{ $bodyClass or '' }} skin-purple sidebar-mini on-loading @php do_action(BASE_ACTION_BODY_CLASS) @endphp">

<!-- Loading state -->
<div class="page-spinner-bar">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<!-- Loading state -->

@if(!isset($isAuthPages) || !$isAuthPages)
    <div class="wrapper">
        {{--BEGIN Header--}}
        @include('webed-core::admin._partials.header')
        {{--END Header--}}

        {{--BEGIN Sidebar--}}
        @include('webed-core::admin._partials.sidebar')
        {{--END Sidebar--}}

        <div class="content-wrapper">
            <section class="content-header">
                {{--BEGIN Page title--}}
                @include('webed-core::admin._partials.page-title')
                {{--END Page title--}}
                {{--BEGIN Breadcrumbs--}}
                @include('webed-core::admin._partials.breadcrumbs')
                {{--END Breadcrumbs--}}
            </section>

            <section class="content">
                {{--BEGIN Flash messages--}}
                @include('webed-core::admin._partials.flash-messages')
                {{--END Flash messages--}}

                {{--BEGIN Content--}}
                @yield('content')
                {{--END Content--}}
            </section>
        </div>

        {{--BEGIN Footer--}}
        @include('webed-core::admin._partials.footer')
        {{--END Footer--}}

        {{--BEGIN control sidebar--}}
        @include('webed-core::admin._partials.control-sidebar')
        {{--END control sidebar--}}
    </div>
@else
    <div class="auth-actions-bar">
        <div class="text-right">
            <div class="dropdown">
                <a href="javascript:;"
                   class="dropdown-toggle"
                   data-toggle="dropdown"
                   data-hover="dropdown"
                   data-close-others="true">
                    {{ trans('webed-core::languages.' . dashboard_language()->getDashboardLanguage()) }}
                    <span class="fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    @foreach(config('webed.languages', []) as $slug => $language)
                        <li class="{{ $slug == dashboard_language()->getDashboardLanguage() ? 'active' : '' }}">
                            <a href="{{ route('admin::dashboard-language.get', [$slug]) }}">
                                {{ trans('webed-core::languages.' . $slug) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @yield('content')
@endif

{{--Modals--}}
@include('webed-core::admin._partials.modals')

<!--[if lt IE 9]>
    <script src="admin/plugins/respond.min.js"></script>
    <script src="admin/plugins/excanvas.min.js"></script>
    <![endif]-->

    {{--BEGIN plugins--}}
    <script src="{{ asset('admin/theme/lte/js/app.js') }}"></script>
    <script src="{{ asset('admin/js/webed-core.js') }}"></script>
    <script src="{{ asset('admin/theme/lte/js/demo.js') }}"></script>
    {!! assets_management()->renderScripts('bottom') !!}
    {{--END plugins--}}

    @php do_action(BASE_ACTION_FOOTER_JS) @endphp

    <script src="{{ asset('admin/js/script.js') }}"></script>

    @stack('js')

    @yield('js')

    @stack('js-init')

    @yield('js-init')

</body>

</html>
