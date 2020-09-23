<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->prefix('api')->group(function() {
    Route::resource('codes', 'CodeController')->only(['index', 'show', 'store', 'update']);
    Route::resource('competitions', 'CompetitionController')->only(['store']);
    Route::post('winners/has-won', 'WinnerController@hasWon')->name('api.winners.hasWon');
    Route::resource('winners', 'WinnerController')->only(['index']);
});

Route::get('/', function(){
    return view('welcome');
});

Route::get('/admin', 'AdminController@index');
Route::get('/admin/{any}', 'AdminController@index')->where('any','(.*)');
