<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Stats FC Dugout - @yield('title')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400|Source+Code+Pro" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/highlight/github.css') }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="https://pl.statsfc.com/j/iframeResizer.contentWindow.min.js"></script>
    </head>

    <body>
        <div class="container">
            <h1 class="text-center home-title"><a href="/">Stats FC Dugout</a></h1>

            @yield('content')
        </div>

        <footer class="text-center">
            <ul class="list-inline">
                <li>
                    <a class="text-muted" href="https://twitter.com/StatsFC" target="_blank">
                        <span class="sr-only">Twitter</span>
                        <i class="fa fa-twitter fa-3x"></i>
                    </a>
                </li>
                <li>
                    <a class="text-muted" href="mailto:hello@statsfc.com">
                        <span class="sr-only">Email</span>
                        <i class="fa fa-envelope fa-3x"></i>
                    </a>
                </li>
                <li>
                    <a class="text-muted" href="https://github.com/StatsFC/statsfc-api" target="_blank">
                        <span class="sr-only">GitHub</span>
                        <i class="fa fa-github fa-3x"></i>
                    </a>
                </li>
                <li>
                    <a class="text-muted" href="https://www.linkedin.com/company/stats-fc-ltd" target="_blank">
                        <span class="sr-only">LinkedIn</span>
                        <i class="fa fa-linkedin fa-3x"></i>
                    </a>
                </li>
            </ul>

            <p class="text-muted">
                <a href="http://status.statsfc.com" target="_blank">Status</a>
                <i class="fa fa-fw fa-flash"></i>
                <small>Copyright © {{ Carbon\Carbon::now()->year }} Stats FC</small>
            </p>
        </footer>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script src="{{ asset('js/highlight.pack.js') }}"></script>
        <script>hljs.initHighlightingOnLoad();</script>

        <script src="{{ asset('js/tracking.js') }}"></script>

        @yield('script')
    </body>
</html>
