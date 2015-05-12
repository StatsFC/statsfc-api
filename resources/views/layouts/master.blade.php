<!DOCTYPE html>
<html lang="en">
    <head>
        <title>StastFC Dugout - @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400|Source+Code+Pro" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/highlight/github.css') }}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/github-fork-ribbon-css/0.1.1/gh-fork-ribbon.ie.min.css" rel="stylesheet">
        <![endif]-->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script src="{{ asset('js/highlight.pack.js') }}"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>

    <body>
        <div class="container">
            @yield('content')
        </div>

        <div class="github-fork-ribbon-wrapper right">
            <div class="github-fork-ribbon">
                <a href="https://github.com/statsfc/statsfc-api">Fork me on GitHub</a>
            </div>
        </div>
    </body>
</html>
