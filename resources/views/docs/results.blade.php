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
