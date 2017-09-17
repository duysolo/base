@extends('webed-theme::front._master')

@section('content')
    <div class="container">
        <div class="main-content">
            <div class="main-left">
                <section class="main-box">
                    <div class="main-box-header">
                        <h2><i class="fa fa-leaf"></i> Video Clip</h2>
                    </div>
                    <div class="main-box-content">
                        <div class="box-style box-style-4">
                            @foreach($posts as $post)
                                <div class="media-news media-video">
                                    <a href="{{ get_post_link($post) }}"
                                       class="media-news-img"
                                       title="{{ $post->title }}">
                                        <img class="img-full img-bg"
                                             src="themes/news-tv/images/img-size/news.png"
                                             style="background-image: url('{{ get_image($post->thumbnail) }}');"
                                             alt="{{ $post->title }}">
                                    </a>
                                    <div class="media-news-body">
                                        <p class="common-title">
                                            <a href="{{ get_post_link($post) }}"
                                               title="{{ $post->title }}">
                                                {{ limit_chars($post->title, 75) }}
                                            </a>
                                        </p>
                                        <p class="common-date">
                                            <time datetime="">{{ $post->created_at }}</time>
                                        </p>
                                        <div class="common-summary">{{ str_limit($post->description, 100) }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </section>
                {!! pagination_advanced($posts, [
                    'group_class' => 'pagination pagination-lg'
                ]) !!}
            </div>
            @include("webed-theme::front._partials.sidebar")
        </div>
    </div>
@endsection
