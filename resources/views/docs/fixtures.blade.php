<div class="panel panel-default">
    <div class="panel-heading solo">
        <pre>GET /fixtures</pre>
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
                "season": {
                    "id": 10,
                    "name": "2015\/2016"
                }
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
            "score": [
                0,
                0
            ],
            "currentState": "HT",
            "events": [
                "cards": [],
                "goals": [],
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
                <td>The season the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>season_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the season the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>competition</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the competition the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>competition_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the competition the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>competition_key</samp></td>
                <td><samp>string</samp></td>
                <td>The key of the competition the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>team</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the home or away team the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>team_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the home or away team the fixtures are in</td>
            </tr>
            <tr>
                <td><samp>from</samp></td>
                <td><samp>string</samp></td>
                <td>The earliest date to return fixtures from. This is a date in ISO 8601 format: <samp>YYYY-MM-DD</samp></td>
            </tr>
            <tr>
                <td><samp>to</samp></td>
                <td><samp>string</samp></td>
                <td>The latest date to return fixtures to. This is a date in ISO 8601 format: <samp>YYYY-MM-DD</samp></td>
            </tr>
        </tbody>
    </table>
</section>
