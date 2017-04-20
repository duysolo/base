@extends('webed-theme::front._master')

@section('content')
    <section id="error-page">
        <div class="error-page-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <div class="bg-404">
                                <div class="error-image">
                                    <h1 style="font-size: 80px;">503</h1>
                                </div>
                            </div>
                            <h2>SERVICE UNAVAILABLE</h2>
                            <p>This site is on maintenance mode. Try to access later or contact to administrator</p>
                            @include('webed-theme::front.errors._error-partials')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection