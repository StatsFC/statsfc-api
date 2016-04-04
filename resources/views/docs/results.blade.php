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
                "cards": [
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
                    }
                ],
                "goals": [],
                "states": [],
                "substitutions": []
            ]
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
                        <li><samp>state</samp></li>
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
