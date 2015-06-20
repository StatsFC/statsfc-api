@extends('layouts.master')

@section('title', 'Documentation')

@section('content')
    <h1 class="text-center home-title">Documentation</h1>

    <div class="row">
        <div class="col-md-9">
            @foreach ($sections as $id => $name)
                <article id="{{ $id }}">
                    <h3>{{ $name }}</h3>

                    @include('docs.' . $id)
                </article>
            @endforeach
        </div>

        <div class="col-md-3">
            <nav class="list-group">
                @foreach ($sections as $id => $name)
                    <a href="#{{ $id }}" class="list-group-item {!! $id === 'authentication' ? 'active' : '' !!}">{{ $name }}</a>
                @endforeach
            </nav>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(function() {
            $('.list-group-item').on('click', function() {
                $('.list-group-item.active').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@stop
