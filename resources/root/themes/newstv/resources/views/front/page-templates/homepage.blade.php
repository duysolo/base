@extends('webed-theme::front._master')

@section('js-init')
    <script>
        $('.banner-slider-wrap').slick({
            dots: true
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="main-feature">
            @foreach($mainFeatures as $feature)
                <div class="feature-item">
                    <div class="feature-item-dv">
                        <a href="{{ get_post_link($feature) }}" title="{{ $feature->title }}" style="display: block">
                            <img class="img-full img-bg" src="{{ asset('themes/news-tv/images/img-size/news.png') }}"
                                 style="background-image: url('{{ get_image($feature->thumbnail) }}');"
                                 alt="{{ $feature->title }}">
                            <span class="feature-item-link"
                                  title="{{ $feature->title }}">
                                <span>{{ $feature->title }}</span>
                            </span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="main-content">
            <div class="main-left">
                <?php
                $position = 0;
                ?>
                @foreach($categories as $key => $category)
                    <section class="main-box">
                        <div class="main-box-header">
                            <div class="btn-group">
                                <button type="button"
                                        class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    Chọn <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @foreach($category->child_cats as $childCategory)
                                        <li>
                                            <a href="{{ get_category_link($childCategory) }}"
                                               title="{{ $childCategory->title }}">
                                                {{ $childCategory->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <h2>
                                <i class="fa fa-leaf"></i> {{ $category->title }}
                            </h2>
                        </div>
                        <div class="main-box-content">
                            <div class="box-style box-style-{{ $position % 2 == 0 ? 1 : 2 }}">
                                @foreach($category->fetched_posts as $post)
                                    <div class="media-news">
                                        <a href="{{ get_post_link($post) }}"
                                           title="{{ $post->title }}"
                                           class="media-news-img">
                                            <img class="img-full img-bg"
                                                 src="{{ asset('themes/news-tv/images/img-size/news.png') }}"
                                                 style="background-image: url('{{ get_image($post->thumbnail) }}');"
                                                 alt="{{ $post->title }}">
                                        </a>
                                        <div class="media-news-body">
                                            <p class="common-title">
                                                <a href="{{ get_post_link($post) }}" title="{{ $post->title }}">
                                                    {{ $post->title }}
                                                </a>
                                            </p>
                                            <p class="common-date">
                                                <time datetime="">{{ $post->created_at }}</time>
                                            </p>
                                            <div class="common-summary">
                                                {!! limit_chars(custom_strip_tags($post->description), 150) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <?php
                        $position++;
                        ?>
                    </section>
                @endforeach
            </div>
            @include('webed-theme::front._partials.sidebar')
        </div>
    </div>
@endsection
