<div class="container">
    {!! $footerMenuHtml !!}
    <div class="footer-txt">
        <p>
            <a href="{{ get_homepage_link() }}">
                <img src="{{ asset('themes/news-tv/images/logo.png') }}" alt="{{ get_setting('site_title') }}">
            </a>
        </p>
        <p>{{ get_theme_option('footer_information') }}</p>
        <div class="hi-icon-wrap hi-icon-effect-3 hi-icon-effect-3a">
            <a href="{{ get_setting('facebook') }}" class="hi-icon fa fa-facebook"></a>
            <a href="{{ get_setting('google_plus') }}" class="hi-icon fa fa-google-plus"></a>
            <a href="{{ get_setting('youtube') }}" class="hi-icon fa fa-youtube"></a>
        </div>
    </div>
</div>
<div class="footer-end">
    <div class="container">
        <p>{!! get_theme_option('footer_copyright') !!}</p>
    </div>
</div>
