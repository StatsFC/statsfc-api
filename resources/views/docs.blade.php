@extends('layouts.master')

@section('title', 'Documentation')

@section('content')
    <p class="text-center home-tagline">The complete documentation of our JSON API</p>

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
            <div id="docs-nav">
                <div class="list-group">
                    @foreach ($sections as $id => $name)
                        <a href="#{{ $id }}" class="list-group-item">{{ $name }}</a>
                    @endforeach
                </div>
            </div>
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

            var $nav       = $('#docs-nav');
            var $navParent = $nav.parent();

            $nav.affix({
                offset: {
                    top: $navParent.offset().top - 20
                }
            }).width($navParent.width());
        });
    </script>
@stop
