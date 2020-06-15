<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: {api_key}&quot; https://dugout.statsfc.com/api/v2/results">
</div>

<pre><code class="json">{
    "data": [
        {
            "id": 69540,
            "timestamp": "2016-08-14T15:00:00+0000",
            "competition": {
                "id": 2,
                "name": "Premier League",
                "key": "EPL",
                "region": "England"
            },
            "round": {
                "id": 1044,
                "name": "Premier League",
                "season": {
                    "id": 10,
                    "name": "2016\/2017"
                },
            },
            "teams": {
                "home": {
                    "id": 18,
                    "name": "Arsenal",
                    "shortName": "Arsenal"
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
                        "id": 16976,
                        "number": 33,
                        "position": "GK",
                        "role": "starting",
                        "name": "Petr \u010cech"
                    }
                ],
                "away": [
                    {
                        "id": 17018,
                        "number": 22,
                        "position": "GK",
                        "role": "starting",
                        "name": "Simon Mignolet"
                    }
                ]
            },
            "score": [
                3,
                4
            ],
            "currentState": "FT",
            "events": {
                "cards": [
                    {
                        "id": 41059,
                        "matchTime": "25'",
                        "type": "card",
                        "subType": "first-yellow",
                        "team": {
                            "id": 1,
                            "name": "Liverpool",
                            "shortName": "Liverpool"
                        },
                        "player": {
                            "id": "17235",
                            "name": "Adam Lallana",
                            "position": "MF"
                        }
                    }
                ],
                "goals": [
                    {
                        "id": 160439,
                        "matchTime": "29'",
                        "type": "goal",
                        "subType": null,
                        "team": {
                            "id": 18,
                            "name": "Arsenal",
                            "shortName": "Arsenal"
                        },
                        "player": {
                            "id": "17476",
                            "name": "Theo Walcott",
                            "position": "FW"
                        },
                        "assist": {
                            "id": "34666",
                            "name": "Alex Iwobi",
                            "position": "FW"
                        }
                    }
                ],
                "substitutions": [
                    {
                        "id": 57247,
                        "matchTime": "60'",
                        "type": "substitution",
                        "subType": null,
                        "team": {
                            "id": 18,
                            "name": "Arsenal",
                            "shortName": "Arsenal"
                        },
                        "playerOff": {
                            "id": "17478",
                            "name": "Aaron Ramsey",
                            "position": "MF"
                        },
                        "playerOn": {
                            "id": "17480",
                            "name": "Santi Cazorla",
                            "position": "MF"
                        }
                    }
                ]
            }
        }
    ]
}</code></pre>
