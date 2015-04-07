<?php
Route::get('/', function() {
    return 'StatsFC API';
});

Route::get('competitions', 'CompetitionsController@index');
