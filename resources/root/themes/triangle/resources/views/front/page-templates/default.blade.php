@extends('webed-theme::front._master')

@section('content')
    <div class="container">
        <article>
            {!! $object->content or '' !!}
        </article>
    </div>
@endsection
