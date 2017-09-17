<div class="header-wrap">
    <nav class="nav-top">
        <div class="container">
            {!! $topCmsMenuHtml or $globalTopMenuHtml !!}
            <div class="pull-right">
                <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a">
                    <a href="{{ get_setting('facebook') }}" class="hi-icon fa fa-facebook"></a>
                    <a href="{{ get_setting('google_plus') }}" class="hi-icon fa fa-google-plus"></a>
                    <a href="{{ get_setting('youtube') }}" class="hi-icon fa fa-youtube"></a>
                </div>
            </div>
        </div>
    </nav>
    <div class="header-content">
        <div class="container">
            <h1 class="logo">
                <a href="{{ get_homepage_link() }}" title="{{ get_setting('site_title') }}">
                    <img src="{{ asset('themes/news-tv/images/logo.png') }}" alt="{{ get_setting('site_title') }}">
                </a>
            </h1>
            <div class="header-content-right">
                {!! do_shortcode('[static_block alias="top-ad"]') !!}
            </div>
        </div>
    </div>
</div>
<section class="header-hotnews">
    <div class="container">
        <div class="hotnews-content">
            <h2 class="hotnews-tt">{{ trans('webed-theme::base.hot_of_the_day') }}</h2>
            <div class="hotnews-dv">
                <div class="hotnews-slideshow">
                    <div class="js-marquee">
                        @foreach($popularPosts as $post)
                            <a href="{{ get_post_link($post) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('') }}" title="{{ get_setting('site_title') }}">
                <img src="{{ asset('themes/news-tv/images/logo.png') }}" alt="{{ get_setting('site_title') }}">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            {!! $globalMenuHtml !!}
            <form class="navbar-form navbar-right"
                  role="search"
                  accept-charset="UTF-8"
                  action="{{ search_url() }}"
                  method="GET">
                <div class="tn-searchtop">
                    <button type="button" class="btn btn-default js-btn-searchtop">
                        <i class="fa fa-times"></i>
                    </button>
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{ trans('webed-theme::base.search_news') }}" name="k">
                    </div>
                </div>
                <button id="tn-searchtop" class="js-btn-searchtop" type="button"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>
