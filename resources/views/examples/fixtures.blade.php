<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: &lt;API key&gt;&quot; https://dugout.statsfc.com/api/v1/fixtures">
</div>

<pre><code class="json">{
    "data": [
        {
            "id": 3822,
            "timestamp": "2015-05-04T19:00:00+0000",
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
                    "id": 366,
                    "name": "Hull City",
                    "shortName": "Hull"
                },
                "away": {
                    "id": 18,
                    "name": "Arsenal",
                    "shortName": "Arsenal"
                }
            },
            "score": null,
            "currentState": {
                "id": 2,
                "key": "FX",
                "name": "Fixture"
            },
            "events": []
        },
        …
    ]
}</code></pre>
