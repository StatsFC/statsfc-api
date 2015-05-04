<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-Auth-Key: &lt;API key&gt;&quot; https://offside.statsfc.com/api/v1/results">
</div>

<pre><code class="json">{
    "data": [
        {
            "id": 3791,
            "timestamp": "2015-04-13T19:00:00+0000",
            "competition": {
                "id": 2,
                "name": "Premier League",
                "key": "EPL",
                "region": "England"
            },
            "round": {
                "id": 107,
                "name": "Premier League",
                "start": "2014-08-15",
                "end": null
            },
            "teams": {
                "home": {
                    "id": 1,
                    "name": "Liverpool",
                    "shortName": "Liverpool"
                },
                "away": {
                    "id": 19,
                    "name": "Newcastle United",
                    "shortName": "Newcastle"
                }
            },
            "score": [2, 0],
            "currentState": {
                "id": 9,
                "key": "FT",
                "name": "Full-Time"
            },
            "events": []
        },
        …
    ]
}</code></pre>
