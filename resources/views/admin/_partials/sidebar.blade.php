<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $loggedInUser->avatar or '' }}"
                     class="img-circle"
                     alt="{{ $loggedInUser->display_name or '' }}">
            </div>
            <div class="pull-left info">
                <p>{{ $loggedInUser->display_name or '' }}</p>
                <a href="{{ route('admin::users.edit.get', ['id' => $loggedInUser->id]) }}">
                    <i class="fa fa-circle text-success"></i>
                    Online
                </a>
            </div>
        </div>
        <ul class="sidebar-menu">
            {!! $CMSDashboardMenu or '' !!}
        </ul>
    </section>
</aside>
