@extends('webed-theme::front._master')

@section('content')
    <div class="container">
        <div class="main-content">
            <div class="main-left">
                <section class="main-box">
                    <div class="main-box-header">
                        {!! breadcrumbs()->render() !!}
                    </div>
                    <div class="main-box-content">
                        <h1 class="article-content-title">
                            500
                        </h1>
                        <article class="article-content">
                            {{ $exception->getMessage() }}
                        </article>
                    </div>
                </section>
            </div>
            @include("webed-theme::front._partials.sidebar")
        </div>
    </div>
@endsection
