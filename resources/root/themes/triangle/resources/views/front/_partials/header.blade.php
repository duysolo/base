<div class="container">
    <div class="row">
        <div class="col-sm-12 overflow">
            <div class="social-icons pull-right">
                <ul class="nav nav-pills">
                    <li><a href="{{ get_setting('facebook') }}"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ get_setting('youtube') }}"><i class="fa fa-google-plus fa-youtube"></i></a></li>
                    <li><a href="{{ get_setting('github') }}"><i class="fa fa-facebook fa-github"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="navbar navbar-inverse" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ asset('') }}">
                <h1>
                    <img src="themes/triangle/images/logo.png" alt="logo">
                </h1>
            </a>
        </div>
        {!! $cmsMenuHtml or '' !!}
        <div class="search">
            <form role="form" method="GET" action="{{ route('front.search.get') }}">
                <i class="fa fa-search"></i>
                <div class="field-toggle">
                    <input type="text" class="search-form" autocomplete="off" placeholder="Search" name="k">
                </div>
            </form>
        </div>
    </div>
</div>