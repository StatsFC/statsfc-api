@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <p class="text-center home-tagline">The affordable football API</p>

    <p class="text-center home-docs-button">
        <a class="btn btn-info" href="/docs">Full documentation</a>
    </p>

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
