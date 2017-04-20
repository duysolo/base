@extends('webed-theme::front._master')

@section('content')
    <section id="home-slider">
        <div class="container">
            <div class="row">
                <div class="main-slider">
                    <div class="slide-text">
                        <h1>{{ get_field($object->id, WEBED_PAGES, 'top_title') }}</h1>
                        <p>{{ get_field($object->id, WEBED_PAGES, 'top_description') }}</p>
                    </div>
                    <img src="themes/triangle/images/home/slider/hill.png" class="slider-hill" alt="slider image">
                    <img src="themes/triangle/images/home/slider/house.png" class="slider-house" alt="slider image">
                    <img src="themes/triangle/images/home/slider/sun.png" class="slider-sun" alt="slider image">
                    <img src="themes/triangle/images/home/slider/birds1.png" class="slider-birds1" alt="slider image">
                    <img src="themes/triangle/images/home/slider/birds2.png" class="slider-birds2" alt="slider image">
                </div>
            </div>
        </div>
        <div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>
    </section>
    <!--/#home-slider-->

    <section id="services">
        <div class="container">
            <div class="row">
                @foreach(get_field($object->id, WEBED_PAGES, 'services_section', []) as $key => $service)
                    <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms"
                         data-wow-delay="{{ ($key + 1) * 300 }}ms">
                        <div class="single-service">
                            <div class="wow scaleIn" data-wow-duration="500ms"
                                 data-wow-delay="{{ ($key + 1) * 300 }}ms">
                                <img src="{{ get_sub_field($service, 'icon') }}"
                                     alt="{{ get_sub_field($service, 'title') }}">
                            </div>
                            <h2>{{ get_sub_field($service, 'title') }}</h2>
                            <p>{{ get_sub_field($service, 'description') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--/#services-->

    <section id="action" class="responsive">
        <div class="vertical-center">
            <div class="container">
                <div class="row">
                    <div class="action take-tour">
                        <div class="col-sm-7 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                            <h1 class="title">{{ get_field($object->id, WEBED_PAGES, 'tour_title') }}</h1>
                            <p>{{ get_field($object->id, WEBED_PAGES, 'tour_description') }}</p>
                        </div>
                        <div class="col-sm-5 text-center wow fadeInRight" data-wow-duration="500ms"
                             data-wow-delay="300ms">
                            <div class="tour-button">
                                <a href="{{ get_field($object->id, WEBED_PAGES, 'tour_link') }}" class="btn btn-common">TAKE THE TOUR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#action-->

    <section id="features">
        <div class="container">
            <div class="row">
                @foreach(get_field($object->id, WEBED_PAGES, 'features_section', []) as $key => $feature)
                    <div class="single-features">
                        @if(($key + 1) % 2 != 0)
                            <div class="col-sm-5 wow fadeInLeft"
                                 data-wow-duration="500ms"
                                 data-wow-delay="{{ ($key + 1) * 300 }}ms">
                                <img src="{{ get_sub_field($feature, 'feature_image') }}" class="img-responsive" alt="">
                            </div>
                            <div class="col-sm-6 wow fadeInRight"
                                 data-wow-duration="500ms"
                                 data-wow-delay="{{ ($key + 1) * 300 }}ms">
                                <h2>{{ get_sub_field($feature, 'title') }}</h2>
                                <p>{{ get_sub_field($feature, 'description') }}</p>
                            </div>
                        @else
                            <div class="col-sm-6 col-sm-offset-1 align-right wow fadeInLeft"
                                 data-wow-duration="500ms"
                                 data-wow-delay="{{ ($key + 1) * 300 }}ms">
                                <h2>{{ get_sub_field($feature, 'title') }}</h2>
                                <p>{{ get_sub_field($feature, 'description') }}</p>
                            </div>
                            <div class="col-sm-5 wow fadeInRight"
                                 data-wow-duration="500ms"
                                 data-wow-delay="{{ ($key + 1) * 300 }}ms">
                                <img src="{{ get_sub_field($feature, 'feature_image') }}" class="img-responsive" alt="">
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--/#features-->

    <section id="clients">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="clients text-center wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms">
                        <p><img src="themes/triangle/images/home/clients.png" class="img-responsive" alt=""></p>
                        <h1 class="title">{{ get_field($object->id, WEBED_PAGES, 'clients_title') }}</h1>
                        <p>{{ get_field($object->id, WEBED_PAGES, 'clients_description') }}</p>
                    </div>
                    <div class="clients-logo wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                        @foreach(get_field($object->id, WEBED_PAGES, 'clients', []) as $client)
                        <div class="col-xs-3 col-sm-2">
                            <a target="_blank"
                               href="{{ get_sub_field($client, 'website') }}" title="{{ get_sub_field($client, 'name') }}">
                                <img src="{{ get_sub_field($client, 'logo') }}"
                                     class="img-responsive"
                                     alt="{{ get_sub_field($client, 'name') }}">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
