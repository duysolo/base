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
                                    <h1 style="font-size: 80px;">404</h1>
                                </div>
                            </div>
                            <h2>PAGE NOT FOUND</h2>
                            <p>The page you are looking for might have been removed, had its name changed.</p>
                            @include('webed-theme::front.errors._error-partials')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection