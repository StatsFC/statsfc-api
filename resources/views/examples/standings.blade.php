<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: {api_key}&quot; https://dugout.statsfc.com/api/v2/standings">
</div>

<pre><code class="json">{
    "data": [
        {
            "competition": {
                "id": 2,
                "name": "Premier League",
                "key": "EPL",
                "region": "England"
            },
            "round": {
                "id": 107,
                "name": "Premier League",
                "season": {
                    "id": 10,
                    "name": "2015\/2016"
                }
            },
            "team": {
                "id": 7,
                "name": "Chelsea",
                "shortName": "Chelsea"
            },
            "position": 1,
            "played": 38,
            "wins": 26,
            "draws": 9,
            "losses": 3,
            "for": 73,
            "against": 32,
            "difference": 41,
            "points": 87,
            "notes": "Promotion - Champions League (Group Stage)"
        },
        …
    ]
}</code></pre>
