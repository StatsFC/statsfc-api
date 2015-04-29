<?php
Route::group(['prefix' => 'api/v1'], function()
{
    Route::get('/', function()
    {
        return 'StatsFC API';
    });

    Route::resource('competitions', 'CompetitionsController', ['only' => ['index', 'show']]);
    Route::resource('fixtures',     'FixturesController',     ['only' => ['index', 'show']]);
    Route::resource('results',      'ResultsController',      ['only' => ['index', 'show']]);
    Route::resource('states',       'StatesController',       ['only' => ['index', 'show']]);
});
