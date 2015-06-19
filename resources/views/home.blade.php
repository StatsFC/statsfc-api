@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h1 class="text-center home-title">StatsFC Dugout</h1>

    <p class="text-center home-tagline">The affordable football API{{ Carbon\Carbon::now()->toDateString() < '2015-08-01' ? ' – coming August 2015!' : '' }}</p>

    <div class="row">
        <div class="col-md-2"></div>

        <div class="api-sample col-md-8">
            <ul class="nav nav-tabs" id="tabs">
                @foreach ($sections as $id => $name)
                    <li{!! $id === 'competitions' ? ' class="active"' : '' !!}><a href="#{{ $id }}" data-toggle="tab">{{ $name }}</a></li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($sections as $id => $name)
                    <div class="tab-pane{!! $id === 'competitions' ? ' active' : '' !!}" id="{{ $id }}">
                        @include('examples.' . $id)
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>
@stop

@section('script')
    <script>
        $('#tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    </script>
@stop
