<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: {api_key}&quot; https://dugout.statsfc.com/api/v1/results">
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
                "start": null,
                "end": null
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
                        "name": "Petr \u010cech",
                        "shortName": "\u010cech"
                    }
                ],
                "away": [
                    {
                        "id": 17018,
                        "number": 22,
                        "position": "GK",
                        "role": "starting",
                        "name": "Simon Mignolet",
                        "shortName": "Mignolet"
                    }
                ]
            },
            "score": [
                3,
                4
            ],
            "currentState": {
                "id": 9,
                "key": "FT",
                "name": "Full-Time"
            },
            "venue": {
                "id": 47,
                "name": "Emirates Stadium",
                "capacity": 60338
            },
            "events": {
                "cards": [
                    {
                        "id": 41059,
                        "timestamp": "2016-08-14T15:26:15+0000",
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
                            "shortName": "Lallana",
                            "position": "MF"
                        }
                    }
                ],
                "goals": [
                    {
                        "id": 160439,
                        "timestamp": "2016-08-14T15:30:26+0000",
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
                            "shortName": "Walcott",
                            "position": "FW"
                        },
                        "assist": {
                            "id": "34666",
                            "name": "Alex Iwobi",
                            "shortName": "Iwobi",
                            "position": "FW"
                        }
                    }
                ],
                "states": [
                    {
                        "id": 213309,
                        "timestamp": "2016-08-14T15:01:41+0000",
                        "matchTime": "1'",
                        "type": "state",
                        "state": {
                            "id": 1,
                            "key": "1H",
                            "name": "1st Half"
                        }
                    }
                ],
                "substitutions": [
                    {
                        "id": 57247,
                        "timestamp": "2016-08-14T16:17:18+0000",
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
                            "shortName": "Ramsey",
                            "position": "MF"
                        },
                        "playerOn": {
                            "id": "17480",
                            "name": "Santi Cazorla",
                            "shortName": "Cazorla",
                            "position": "MF"
                        }
                    }
                ]
            }
        }
    ]
}</code></pre>
