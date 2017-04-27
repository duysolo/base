<header class="main-header">
    <!-- Logo -->
    <a href="{{ asset('') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>WE</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>WebEd</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @php do_action(BASE_ACTION_HEADER_MENU) @endphp
                <li class="dropdown">
                    <a href="javascript:;"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       data-hover="dropdown"
                       data-close-others="true">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;{{ trans('webed-core::base.add_new') }}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(admin_quick_link()->get() as $type => $linkData)
                            <li>
                                <a href="{{ $linkData['url'] }}">
                                    @if(array_get($linkData, 'icon'))
                                        <i class="ion {{ $linkData['icon'] }}"></i>
                                    @endif
                                    {{ $linkData['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       data-hover="dropdown"
                       data-close-others="true">
                        {{ trans('webed-core::languages.' . dashboard_language()->getDashboardLanguage()) }}
                        <span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach(config('webed.languages', []) as $slug => $language)
                            <li class="{{ $slug == dashboard_language()->getDashboardLanguage() ? 'active' : '' }}">
                                <a href="{{ route('admin::dashboard-language.get', [$slug]) }}">
                                    {{ trans('webed-core::languages.' . $slug) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="dropdown user-menu">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="{{ $loggedInUser->display_name or '' }}"
                             class="img-circle user-image"
                             src="{{ isset($loggedInUser->avatar) ? get_image($loggedInUser->avatar) : get_image(null) }}"
                             width="25"
                             height="25">
                        <span class="hidden-xs">{{ $loggedInUser->display_name or '' }}</span>
                        <span class="fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img alt=""
                                 class="img-circle"
                                 src="{{ isset($loggedInUser->avatar) ? get_image($loggedInUser->avatar) : get_image(null) }}">
                            <p>{{ $loggedInUser->display_name or '' }}</p>
                        </li>
                        <!-- Menu Footer-->
                        @if (isset($loggedInUser))
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ route('admin::users.edit.get', ['id' => $loggedInUser->id]) }}"
                                       class="btn btn-default btn-flat">
                                        <i class="icon-user"></i> {{ trans('webed-users::base.profile') }}
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('admin::auth.logout.get') }}" class="btn btn-default btn-flat">
                                        <i class="icon-logout"></i> {{ trans('webed-users::auth.sign_out') }}
                                    </a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </li>
                <li>
                    <a href="{{ asset('') }}" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
