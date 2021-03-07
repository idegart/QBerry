<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;

Route::apiResource('episodes', EpisodeController::class)->only('index', 'show');
Route::apiResource('characters', CharacterController::class)->only('index');
Route::apiResource('quotes', QuoteController::class)->only('index');

Route::prefix('characters')->group(function () {
    Route::get('random', [CharacterController::class, 'random'])->name('characters.random');
});

Route::prefix('quotes')->group(function () {
    Route::get('random', [QuoteController::class, 'random'])->name('quotes.random');
});
