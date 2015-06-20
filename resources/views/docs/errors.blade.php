<section>
    <h5>Responses</h5>

    <p>An API key has not been provided by the <code>X-StatsFC-Key</code> header.</p>

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
    </div>

    <p>The API key provided cannot be found.</p>

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
    </div>

    <p>The IP address of your request does not match the IP address in <a href="https://statsfc.com/account" target="_blank">your account</a>.</p>

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
    </div>

    <p>The competition requested is not included in your API subscription.</p>

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
    </div>

    <p>The request has not been filtered by competition or team. Relating to <a href="#top-scorers">Top Scorers</a> only.</p>

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
    </div>

    <p>Your account has exceeded it's rate limit for the day.</p>

    <div class="panel panel-default">
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
    </div>
</section>
