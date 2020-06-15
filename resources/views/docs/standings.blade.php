<div class="panel panel-default">
    <div class="panel-heading solo">
        <pre>GET /standings</pre>
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
            "season": {
                "id": 10,
                "name": "2014\/2015"
            },
            "competition": {
                "id": 2,
                "name": "Premier League",
                "key": "EPL",
                "region": "England"
            },
            "group": null,
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
                <td>The season for the standings</td>
            </tr>
            <tr>
                <td><samp>competition</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the competition for the standings</td>
            </tr>
            <tr>
                <td><samp>competition_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the competition for the standings</td>
            </tr>
            <tr>
                <td><samp>competition_key</samp></td>
                <td><samp>string</samp></td>
                <td>The key of the competition for the standings</td>
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
                <td><samp>info</samp></td>
                <td><samp>string</samp></td>
                <td>
                    <ul class="list-unstyled">
                        <li><samp>top1</samp></li>
                        <li><samp>top2</samp></li>
                        <li><samp>top3</samp></li>
                        <li><samp>top4</samp></li>
                        <li><samp>bottom1</samp></li>
                    </ul>
                </td>
                <td>Meta data about the tier of the league position</td>
            </tr>
        </tbody>
    </table>
</section>
