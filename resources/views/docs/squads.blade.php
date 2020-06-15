<div class="panel panel-default">
    <div class="panel-heading solo">
        <pre>GET /squads</pre>
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
            "team": {
                "id": 18,
                "name": "Arsenal",
                "shortName": "Arsenal"
            },
            "players": [
                {
                    "id": "17478",
                    "name": "A. Ramsey",
                    "position": "MF"
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
        </tbody>
    </table>
</section>
