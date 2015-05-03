@extends('layouts.master')

@section('title', 'Home')

@section('content')
    <h1 class="text-center home-title">StatsFC Offside</h1>

    <p class="text-center home-tagline">The affordable football API</p>

    <div class="row">
        <div class="col-md-2"></div>

        <div class="api-sample col-md-8">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">
                    <span class="glyphicon glyphicon-console" aria-hidden="true"></span>
                </span>
                <input type="text" class="form-control api-curl" aria-describedby="basic-addon1" value="curl -H &quot;X-Auth-Key: &lt;API key&gt;&quot; https://offside.statsfc.com/api/v1/competitions">
            </div>

            <pre><code class="json">{
    "data": [
        {
            "id": 2,
            "name": "Premier League",
            "key": "EPL",
            "region": "England",
            "rounds": [
                {
                    "id": 107,
                    "name": "Premier League",
                    "start": "2014-08-15",
                    "end": null
                }
            ]
        },
        …
    ]
}</code></pre>
        </div>

        <div class="col-md-2"></div>
    </div>
@stop
