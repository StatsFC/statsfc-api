<div class="panel panel-default">
    <div class="panel-heading solo">
        <pre>GET /results</pre>
    </div>
</div>

<section>
    <h5>Response</h5>

    <div class="panel panel-default">
        <div class="panel-heading">
            <pre>Status: 200 OK</pre>
        </div>
        <div class="panel-body">
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
                }
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
                        "name": "P. \u010cech"
                    }
                ],
                "away": [
                    {
                        "id": 17018,
                        "number": 22,
                        "position": "GK",
                        "role": "starting",
                        "name": "S. Mignolet"
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
                            "name": "A. Lallana",
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
                            "name": "T. Walcott",
                            "position": "FW"
                        },
                        "assist": {
                            "id": "34666",
                            "name": "A. Iwobi",
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
                            "name": "A. Ramsey",
                            "position": "MF"
                        },
                        "playerOn": {
                            "id": "17480",
                            "name": "S. Cazorla",
                            "position": "MF"
                        }
                    }
                ]
            }
        }
    ]
}</code></pre>
        </div>
    </div>
</section>

<section>
    <h5>Optional Parameters</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><samp>season</samp></td>
                <td><samp>string</samp></td>
                <td>The season the results are in</td>
            </tr>
            <tr>
                <td><samp>season_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the season the results are in</td>
            </tr>
            <tr>
                <td><samp>competition</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the competition the results are in</td>
            </tr>
            <tr>
                <td><samp>competition_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the competition the results are in</td>
            </tr>
            <tr>
                <td><samp>competition_key</samp></td>
                <td><samp>string</samp></td>
                <td>The key of the competition the results are in</td>
            </tr>
            <tr>
                <td><samp>team</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the home or away team the results are in</td>
            </tr>
            <tr>
                <td><samp>team_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the home or away team the results are in</td>
            </tr>
            <tr>
                <td><samp>from</samp></td>
                <td><samp>string</samp></td>
                <td>The earliest date to return results from. This is a date in ISO 8601 format: <samp>YYYY-MM-DD</samp></td>
            </tr>
            <tr>
                <td><samp>to</samp></td>
                <td><samp>string</samp></td>
                <td>The latest date to return results to. This is a date in ISO 8601 format: <samp>YYYY-MM-DD</samp></td>
            </tr>
        </tbody>
    </table>
</section>

<sectipn>
    <h5>Possible Values</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Values</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-nowrap">
                    <samp>players</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>home</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>position</samp>
                    <br>
                    <samp>players</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>away</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>position</samp>
                    <br>
                    <samp>events</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>player</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>position</samp>
                </td>
                <td><samp>string</samp></td>
                <td>
                    <ul class="list-unstyled">
                        <li><samp>GK</samp></li>
                        <li><samp>DF</samp></li>
                        <li><samp>MF</samp></li>
                        <li><samp>FW</samp></li>
                    </ul>
                </td>
                <td>The player's general position</td>
            </tr>
            <tr>
                <td class="text-nowrap">
                    <samp>players</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>home</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>role</samp>
                    <br>
                    <samp>players</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>away</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>role</samp>
                </td>
                <td><samp>string</samp></td>
                <td>
                    <ul class="list-unstyled">
                        <li><samp>starting</samp></li>
                        <li><samp>sub</samp></li>
                    </ul>
                </td>
                <td>The player's role at the start of the match</td>
            </tr>
            <tr>
                <td class="text-nowrap">
                    <samp>events</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>type</samp>
                </td>
                <td><samp>string</samp></td>
                <td>
                    <ul class="list-unstyled">
                        <li><samp>goal</samp></li>
                        <li><samp>card</samp></li>
                        <li><samp>substitution</samp></li>
                        <li>
                            <samp>penalties</samp>
                            <small>(indicating the start of a penalty shootout)</small>
                        </li>
                        <li>
                            <samp>penalty</samp>
                            <small>(indicating an individual penalty in a shootout)</small>
                        </li>
                    </ul>
                </td>
                <td>The primary type of the event</td>
            </tr>
            <tr>
                <td class="text-nowrap">
                    <samp>events</samp>
                    <i class="fa fa-long-arrow-right"></i>
                    <samp>subType</samp>
                </td>
                <td><samp>string</samp></td>
                <td>
                    <ul class="list-unstyled">
                        <li>
                            <samp>penalty</samp>
                            <small>(relating to <samp>goal</samp> type)</small>
                        </li>
                        <li>
                            <samp>own-goal</samp>
                            <small>(relating to <samp>goal</samp> type)</small>
                        </li>
                        <li>
                            <samp>first-yellow</samp>
                            <small>(relating to <samp>card</samp> type)</small>
                        </li>
                        <li>
                            <samp>second-yellow</samp>
                            <small>(relating to <samp>card</samp> type)</small>
                        </li>
                        <li>
                            <samp>red</samp>
                            <small>(relating to <samp>card</samp> type)</small>
                        </li>
                    </ul>
                </td>
                <td>The secondary type of the event</td>
            </tr>
        </tbody>
    </table>
</section>
