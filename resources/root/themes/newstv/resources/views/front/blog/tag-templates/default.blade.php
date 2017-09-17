<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $posts
 */
?>
@extends('webed-theme::front._master')

@section('content')
    <div class="container">
        <div class="main-content">
            <div class="main-left">
                <section class="main-box">
                    <div class="main-box-header">
                        <h2>
                            <i class="fa fa-leaf"></i>
                            Tag: {{ $object->title }}
                        </h2>
                    </div>
                    <div class="main-box-content">
                        <div class="box-style box-style-3">
                            @foreach($relatedPosts as $post)
                                <div class="media-news">
                                    <a href="{{ get_post_link($post) }}"
                                       class="media-news-img"
                                       title="{{ $post->title }}">
                                        <img class="img-full img-bg"
                                             src="{{ asset('themes/news-tv/images/img-size/news.png') }}"
                                             style="background-image: url('{{ get_image($post->thumbnail) }}');"
                                             alt="{{ $post->title }}">
                                    </a>
                                    <div class="media-news-body">
                                        <p class="common-title">
                                            <a href="{{ get_post_link($post) }}"
                                               title="{{ $post->title }}">
                                                {{ $post->title }}
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
                {!! pagination_advanced($relatedPosts, [
                    'group_class' => 'pagination pagination-lg'
                ]) !!}
            </div>
            @include("webed-theme::front._partials.sidebar")
        </div>
    </div>
@endsection
