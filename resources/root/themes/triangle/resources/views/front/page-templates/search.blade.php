@extends('webed-theme::front._master')

@section('content')
    @include('webed-theme::front._partials.breadcrumbs', ['title' => 'Search', 'description' => request()->get('k')])

    <section id="search" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-sm-12 col-md-12">
                                <div class="single-blog single-column">
                                    <div class="post-thumb">
                                        <a href="{{ get_post_link($post) }}">
                                            <img src="{{ get_image($post->thumbnail) }}" class="img-responsive"
                                                 alt="{{ $post->title }}">
                                        </a>
                                        <div class="post-overlay">
                                            <span class="uppercase">
                                                <a href="{{ get_post_link($post) }}">
                                                    {{ format_date($post->created_at, 'd') }}
                                                    <br>
                                                    <small>{{ format_date($post->created_at, 'M') }}</small>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="post-content overflow">
                                        <h2 class="post-title bold">
                                            <a href="{{ get_post_link($post) }}"
                                               title="{{ $post->title }}">{{ $post->title }}</a>
                                        </h2>
                                        <h3 class="post-author">
                                            <a>Posted by {{ $post->author ? $post->author->username : 'administrator' }}</a> <small class="post-date">{{ $post->created_at }}</small>
                                        </h3>
                                        <p>{{ $post->description }}</p>
                                        <a href="{{ get_post_link($post) }}"
                                           class="read-more"
                                           title="{{ $post->title }}">View More</a>
                                        <div class="post-bottom overflow">
                                            <ul class="navbar-nav post-nav">
                                                <li>
                                                    @foreach($post->tags as $key => $tag)
                                                        <a href="{{ get_tag_link($tag) }}"
                                                           style="margin-right: 15px;"
                                                           title="{{ $tag->title }}">
                                                            <i class="fa fa-tag"></i>
                                                            {{ $tag->title }}
                                                        </a>
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {!! pagination_advanced($posts, [
                        'wrapper_class' => 'blog-pagination',
                        'allowed_query_string' => request()->only(['k']),
                    ]) !!}
                </div>
                <div class="col-md-3 col-sm-5">
                    @include('webed-theme::front._partials.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
