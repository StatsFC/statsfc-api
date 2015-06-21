<?php
Route::get('/',    'HomeController@index');
Route::get('docs', 'DocsController@index');

Route::group(['prefix' => 'api/v1', 'middleware' => 'auth'], function()
{
    Route::resource('competitions', 'CompetitionsController', ['only' => ['index']]);
    Route::resource('fixtures',     'FixturesController',     ['only' => ['index']]);
    Route::resource('results',      'ResultsController',      ['only' => ['index']]);
    Route::resource('seasons',      'SeasonsController',      ['only' => ['index']]);
    Route::resource('squads',       'SquadsController',       ['only' => ['index']]);
    Route::resource('standings',    'StandingsController',    ['only' => ['index']]);
    Route::resource('states',       'StatesController',       ['only' => ['index']]);
    Route::resource('top-scorers',  'TopScorersController',   ['only' => ['index']]);
});
