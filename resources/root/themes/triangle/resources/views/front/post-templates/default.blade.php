@extends('webed-theme::front._master')

@section('content')
    @include('webed-theme::front._partials.breadcrumbs', ['title' => $object->title])

    <section id="blog-details" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-7">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="single-blog single-column">
                                <div class="post-thumb">
                                    <a href="{{ get_post_link($object) }}">
                                        <img src="{{ get_image($object->thumbnail) }}" class="img-responsive"
                                             alt="{{ $object->title }}">
                                    </a>
                                    <div class="post-overlay">
                                            <span class="uppercase">
                                                <a href="{{ get_post_link($object) }}">
                                                    {{ format_date($object->created_at, 'd') }}
                                                    <br>
                                                    <small>{{ format_date($object->created_at, 'M') }}</small>
                                                </a>
                                            </span>
                                    </div>
                                </div>
                                <div class="post-content overflow">
                                    <h2 class="post-title bold">
                                        <a href="{{ get_post_link($object) }}"
                                           title="{{ $object->title }}">{{ $object->title }}</a>
                                    </h2>
                                    <h3 class="post-author">
                                        <a>Posted by {{ $object->author ? $object->author->username : 'administrator' }}</a> <small class="post-date">{{ $object->created_at }}</small>
                                    </h3>
                                    <article class="text-justify">
                                        {!! $object->content !!}
                                    </article>
                                    <div class="post-bottom overflow">
                                        <ul class="navbar-nav post-nav">
                                            <li>
                                                @foreach($object->tags as $key => $tag)
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
                                    <div class="author-profile padding">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <img src="{{ get_image(($object->author ? $object->author->avatar : null)) }}" alt="">
                                            </div>
                                            <div class="col-sm-10">
                                                <h3>{{ $object->author ? $object->author->display_name : 'Administrator' }}</h3>
                                                <p>{{ $object->author ? $object->author->description : '...' }}</p>
                                                <a href="mailto:{{ $object->author ? $object->author->email : '' }}">{{ $object->author ? $object->author->email : '' }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="response-area">
                                        <h2 class="bold">Comments</h2>
                                        <div class="fb-comments-wrapper">
                                            <div class="fb-comments"
                                                 data-href="{{ Request::fullUrl() }}"
                                                 data-width="100%"
                                                 data-numposts="15"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-5">
                    @include('webed-theme::front._partials.sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
