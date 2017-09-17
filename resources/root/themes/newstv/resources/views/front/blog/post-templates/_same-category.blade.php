<section class="main-box">
    <div class="main-box-header">
        <h2><i class="fa fa-leaf"></i> {{ trans('webed-theme::base.in_same_category') }}</h2>
    </div>
    <div class="main-box-content">
        <div class="box-style box-style-4">
            @foreach($postsInSameCategory as $post)
                <div class="media-news">
                    <a href="{{ get_post_link($post) }}" title="{{ $post->title }}"
                       class="media-news-img">
                        <img class="img-full img-bg" src="themes/news-tv/images/img-size/news.png"
                             style="background-image: url('{{ get_image($post->thumbnail) }}');"
                             alt="{{ $post->title }}">
                    </a>
                    <div class="media-news-body">
                        <p class="common-title">
                            <a href="{{ get_post_link($post) }}" title="{{ $post->title }}">
                                {{ str_limit($post->title, 50) }}
                            </a>
                        </p>
                        <p class="common-date">
                            <time datetime="">{{ $post->created_at }}</time>
                        </p>
                        <div class="common-summary">
                            {{ str_limit($post->description, 120) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
