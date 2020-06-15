<div class="panel panel-default">
    <div class="panel-heading solo">
        <pre>GET /top-scorers</pre>
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
            "id": 17183,
            "player": {
                "name": "S. Ag\u00c3\u00bcero"
            },
            "team": {
                "name": "Manchester City",
                "shortName": "Man City"
            },
            "goals": 26
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
                <td>The season the top scorers are from</td>
            </tr>
            <tr>
                <td><samp>competition</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the competition the top scorers are from</td>
            </tr>
            <tr>
                <td><samp>competition_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the competition the top scorers are from</td>
            </tr>
            <tr>
                <td><samp>competition_key</samp></td>
                <td><samp>string</samp></td>
                <td>The key of the competition the top scorers are from</td>
            </tr>
            <tr>
                <td><samp>team</samp></td>
                <td><samp>string</samp></td>
                <td>The name of the home or away team the top scorers are from</td>
            </tr>
            <tr>
                <td><samp>team_id</samp></td>
                <td><samp>integer</samp></td>
                <td>The ID of the home or away team the top scorers are from</td>
            </tr>
        </tbody>
    </table>

    <p>At least one of the <code>competition</code> or <code>team</code> parameters is <strong>required</strong>.</p>
</section>
