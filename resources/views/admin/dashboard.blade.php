@extends('webed-core::admin._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <div class="row stat-boxes">
        @php do_action(WEBED_DASHBOARD_STATS) @endphp
    </div>
    <div class="row other-boxes">
        @php do_action(WEBED_DASHBOARD_OTHERS) @endphp
    </div>
@endsection
