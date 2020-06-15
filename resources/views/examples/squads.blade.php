<div class="input-group">
    <span class="input-group-addon" id="basic-addon1">
        <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
    </span>
    <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-StatsFC-Key: {api_key}&quot; https://dugout.statsfc.com/api/v2/squads">
</div>

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
                },
                …
            ]
        },
        …
    ]
}</code></pre>
