<?php
Route::group(['middleware' => 'maintenance'], function () {
    Route::get('/',    'HomeController@index');
    Route::get('docs', 'DocsController@index');
});

switch (env('VERSION', '1')) {
    case '1':
        Route::group(['prefix' => 'api/v1', 'middleware' => ['auth', 'db']], function () {
            Route::resource('competitions', 'V1\CompetitionsController', ['only' => ['index']]);
            Route::resource('fixtures', 'V1\FixturesController', ['only' => ['index']]);
            Route::resource('results', 'V1\ResultsController', ['only' => ['index']]);
            Route::resource('seasons', 'V1\SeasonsController', ['only' => ['index']]);
            Route::resource('squads', 'V1\SquadsController', ['only' => ['index']]);
            Route::resource('standings', 'V1\StandingsController', ['only' => ['index']]);
            Route::resource('states', 'V1\StatesController', ['only' => ['index']]);
            Route::resource('top-scorers', 'V1\TopScorersController', ['only' => ['index']]);
        });
        break;

    case '2':
        Route::group(['prefix' => 'api/v2', 'middleware' => ['auth', 'db']], function () {
            Route::resource('competitions', 'V1\CompetitionsController', ['only' => ['index']]);
            Route::resource('fixtures', 'V1\FixturesController', ['only' => ['index']]);
            Route::resource('results', 'V1\ResultsController', ['only' => ['index']]);
            Route::resource('seasons', 'V1\SeasonsController', ['only' => ['index']]);
            Route::resource('squads', 'V1\SquadsController', ['only' => ['index']]);
            Route::resource('standings', 'V1\StandingsController', ['only' => ['index']]);
            Route::resource('top-scorers', 'V1\TopScorersController', ['only' => ['index']]);
        });
        break;
}
