<aside class="main-right">
    <div class="aside-box">
        <div class="aside-box-header">
            <h4>{{ trans('webed-theme::base.top_views') }}</h4>
        </div>
        <div class="aside-box-content">
            @foreach($postTopViews as $post)
            <div class="media-news">
                <a href="{{ get_post_link($post) }}" class="media-news-img" title="{{ $post->title }}">
                    <img class="img-full img-bg" src="themes/news-tv/images/img-size/news.png"
                         style="background-image: url('{{ get_image($post->thumbnail) }}');"
                         alt="{{ $post->title }}">
                </a>
                <div class="media-news-body">
                    <p class="common-title">
                        <a href="{{ get_post_link($post) }}" title="{{ $post->title }}">{{ $post->title }}</a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="aside-box">
        <div class="aside-box-header">
            <h4>{{ trans('webed-theme::base.videos') }}</h4>
        </div>
        <div class="aside-box-content">
            @foreach($popularVideos as $video)
                <div class="media-news media-video">
                    <a href="{{ get_post_link($video) }}" class="media-news-img" title="{{ $video->title }}">
                        <img class="img-full img-bg" src="themes/news-tv/images/img-size/news.png"
                             style="background-image: url('{{ get_image($video->thumbnail) }}');"
                             alt="{{ $video->title }}">
                    </a>
                    <div class="media-news-body">
                        <p class="common-title">
                            <a href="{{ get_post_link($video) }}" title="{{ $video->title }}">{{ $video->title }}</a>
                        </p>
                        <p class="common-date">
                            <time datetime="">{{ $video->created_at }}</time>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="fb-page" data-href="{{ get_setting('facebook') }}" data-tabs="timeline"
         data-width="300"
         data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
         data-show-facepile="true">
        <blockquote cite="{{ get_setting('facebook') }}" class="fb-xfbml-parse-ignore"><a
                    href="{{ get_setting('facebook') }}">Facebook</a></blockquote>
    </div>
</aside>
