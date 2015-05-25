<?php
Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth'], function()
{
    Route::resource('competitions', 'CompetitionsController', ['only' => ['index', 'show']]);
    Route::resource('fixtures',     'FixturesController',     ['only' => ['index', 'show']]);
    Route::resource('results',      'ResultsController',      ['only' => ['index', 'show']]);
    Route::resource('seasons',      'SeasonsController',      ['only' => ['index', 'show']]);
    Route::resource('standings',    'StandingsController',    ['only' => ['index']]);
    Route::resource('states',       'StatesController',       ['only' => ['index', 'show']]);
    Route::resource('top-scorers',  'TopScorersController',   ['only' => ['index']]);
});
