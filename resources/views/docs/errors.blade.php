<section>
    <h5>Responses</h5>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 401 Unauthorized</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "API key not provided",
        "statusCode": 401
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            An API key has not been provided by the <code>X-StatsFC-Key</code> header.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 401 Unauthorized</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "API key not found",
        "statusCode": 401
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            The API key provided cannot be found.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 401 Unauthorized</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "IP address does not match",
        "statusCode": 401
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            The IP address of your request does not match the IP address in <a href="https://statsfc.com/account" target="_blank">your account</a>.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 401 Unauthorized</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "The chosen competition is not in your API subscription",
        "statusCode": 401
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            The competition requested is not included in your API subscription.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 401 Unauthorized</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "You must filter by competition or team",
        "statusCode": 401
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            The request has not been filtered by competition or team. Relating to <a href="#top-scorers">Top Scorers</a> and <a href="#squads">Squads</a> only.
        </div>
    </div>

    <div class="panel panel-default" id="errors-rate-limit">
        <div class="panel-heading">
            <pre>Status: 429 Too Many Requests</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "Rate limit exceeded",
        "statusCode": 429
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            Your account has exceeded it's rate limit for the day.
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 503 Service Unavailable</pre>
        </div>

        <div class="panel-body">
            <pre><code class="json">{
    "error": {
        "message": "Down for maintenance. We'll be right back",
        "statusCode": 503
    }
}</code></pre>
        </div>

        <div class="panel-footer">
            The API is down for maintenance, but should be back very soon!
        </div>
    </div>
</section>
