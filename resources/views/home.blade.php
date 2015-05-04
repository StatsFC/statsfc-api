@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h1 class="text-center home-title">StatsFC Offside</h1>

    <p class="text-center home-tagline">The affordable football API</p>

    <div class="row">
        <div class="col-md-2"></div>

        <div class="api-sample col-md-8">
            <ul class="nav nav-tabs" id="tabs">
                <li class="active"><a href="#competitions" data-toggle="tab">Competitions</a></li>
                <li><a href="#states" data-toggle="tab">States</a></li>
                <li><a href="#fixtures" data-toggle="tab">Fixtures</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="competitions">
                    @include('examples.competitions')
                </div>
                <div class="tab-pane" id="states">
                    @include('examples.states')
                </div>
                <div class="tab-pane" id="fixtures">
                    @include('examples.fixtures')
                </div>
            </div>
        </div>

        <div class="col-md-2"></div>
    </div>

    <script>
        $('#tabs a').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    </script>
@stop
