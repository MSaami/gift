<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Api')->prefix('api')->group(function() {
    Route::resource('codes', 'CodeController')->only(['index', 'show', 'store', 'update']);
    Route::resource('competitions', 'CompetitionController')->only(['store']);
    Route::post('winners/has-won', 'WinnerController@hasWon')->name('api.winners.hasWon');
    Route::resource('codes.winners', 'WinnerController')->only(['index']);
});
