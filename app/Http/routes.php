<?php
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'api/v1'], function()
{
    Route::resource('competitions', 'CompetitionsController', ['only' => ['index', 'show']]);
    Route::resource('fixtures',     'FixturesController',     ['only' => ['index', 'show']]);
    Route::resource('results',      'ResultsController',      ['only' => ['index', 'show']]);
    Route::resource('states',       'StatesController',       ['only' => ['index', 'show']]);
});
