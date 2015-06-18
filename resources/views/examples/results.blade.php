<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: {api_key}&quot; https://dugout.statsfc.com/api/v1/results">
</div>

<pre><code class="json">{
    "data": [
        {
            "id": 3859,
            "timestamp": "2015-05-24T14:00:00+0000",
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
                "home": [
                    {
                        "id": 17110,
                        "number": 1,
                        "position": "GK",
                        "role": "starting",
                        "name": "Asmir Begovi\u00c4\u2021",
                        "shortName": "Begovi\u00c4\u2021"
                    },
                    …
                ],
                "away": [
                    {
                        "id": 17018,
                        "number": 22,
                        "position": "GK",
                        "role": "starting",
                        "name": "Simon Mignolet",
                        "shortName": "Mignolet"
                    },
                    …
                ]
            },
            "score": [
                6,
                1
            ],
            "currentState": {
                "id": 9,
                "key": "FT",
                "name": "Full-Time"
            },
            "venue": {
                "id": 665,
                "name": "Britannia Stadium",
                "capacity": 27740
            },
            "events": [
                {
                    "id": 15726,
                    "timestamp": "2015-05-24T14:13:33+0000",
                    "matchTime": "13'",
                    "type": "card",
                    "subType": "first-yellow",
                    "team": {
                        "id": 1,
                        "name": "Liverpool",
                        "shortName": "Liverpool"
                    },
                    "player": {
                        "id": "17017",
                        "name": "Lucas Leiva",
                        "shortName": "Leiva",
                        "position": "MF"
                    }
                },
                …
            ]
        },
        …
    ]
}</code></pre>
