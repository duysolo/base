@extends("webed-theme::front._master")

@section("content")
    <div class="container">
        <div class="main-content">
            <div class="main-left">
                <section class="main-box">
                    <div class="main-box-header">
                        {!! breadcrumbs()->render() !!}
                    </div>
                    <div class="main-box-content">
                        <h1 class="article-content-title">{{ $object->title }}</h1>

                        <div class="post-meta">
                            <span><i class="fa fa-user"></i> {{ $object->author->display_name or 'Admin' }}</span>
                            <span><i class="fa fa-calendar"></i> {{ $object->created_at }}</span>
                        </div>

                        <div class="post-thumbnail mb20">
                            <img src="{{ get_image($object->thumbnail) }}"
                                 alt="{{ $object->title }}"
                                 width="100%"
                                 class="img-responsive">
                        </div>

                        <div class="article-content">
                            {!! $object->content !!}
                        </div>
                        @include('webed-theme::front._partials.tags', ['relatedTags' => $relatedTags])
                        @include('webed-theme::front._partials.social', ['object' => $object])
                    </div>
                </section>
                @include('webed-theme::front.blog.post-templates._same-category', ['postsInSameCategory' => $postsInSameCategory])
            </div>
            @include("webed-theme::front._partials.sidebar")
        </div>
    </div>
@endsection
