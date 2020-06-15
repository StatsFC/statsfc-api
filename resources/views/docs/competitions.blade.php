<div class="panel panel-default">
    <div class="panel-heading solo">
        <pre>GET /competitions</pre>
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
            "id": 2,
            "name": "Premier League",
            "key": "EPL",
            "region": "England",
            "rounds": [
                {
                    "id": 435,
                    "name": "Premier League",
                    "season": {
                        "id": 10,
                        "name": "2015\/2016"
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
                <td><samp>region</samp></td>
                <td><samp>string</samp></td>
                <td>The region of the competition</td>
            </tr>
        </tbody>
    </table>
</section>
