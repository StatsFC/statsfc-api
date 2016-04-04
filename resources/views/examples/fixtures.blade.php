<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: {api_key}&quot; https://dugout.statsfc.com/api/v1/fixtures">
</div>

<pre><code class="json">{
    "data": [
        {
            "id": 21159,
            "timestamp": "2015-08-08T14:00:00+0000",
            "competition": {
                "id": 2,
                "name": "Premier League",
                "key": "EPL",
                "region": "England"
            },
            "round": {
                "id": 435,
                "name": "Premier League",
                "start": "2015-08-07",
                "end": "2016-05-14"
            },
            "teams": {
                "home": {
                    "id": 8,
                    "name": "Stoke City",
                    "shortName": "Stoke"
                },
                "away": {
                    "id": 1,
                    "name": "Liverpool",
                    "shortName": "Liverpool"
                }
            },
            "players": {
                "home": [],
                "away": []
            },
            "score": null,
            "currentState": {
                "id": 4,
                "key": "HT",
                "name": "Half-Time"
            },
            "venue": {
                "id": 665,
                "name": "Britannia Stadium",
                "capacity": 27740
            },
            "events": [
                "cards": [],
                "goals": [],
                "states": [],
                "substitutions": []
            ]
        },
        …
    ]
}</code></pre>
