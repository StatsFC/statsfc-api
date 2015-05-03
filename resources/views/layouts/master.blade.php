<!DOCTYPE html>
<html lang="en">
    <head>
        <title>StastFC Offside - @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400|Source+Code+Pro" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/highlight/github.css') }}" rel="stylesheet">

        <script src="{{ asset('js/highlight.pack.js') }}"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>

    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
