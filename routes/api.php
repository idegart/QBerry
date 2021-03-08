<?php

use App\Http\Controllers\StatController;
use \Illuminate\Http\Request;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthenticateController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthenticateController::class, 'register'])->name('auth.register');

    Route::middleware('auth:sanctum')->get('user', function (Request $request) {
        return $request->user();
    })->name('auth.user');
});

Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
    Route::apiResource('episodes', EpisodeController::class)->only('index', 'show');
    Route::apiResource('characters', CharacterController::class)->only('index');
    Route::apiResource('quotes', QuoteController::class)->only('index');

    Route::prefix('characters')->group(function () {
        Route::get('random', [CharacterController::class, 'random'])->name('characters.random');
    });

    Route::prefix('quotes')->group(function () {
        Route::get('random', [QuoteController::class, 'random'])->name('quotes.random');
    });

    Route::get('stats', [StatController::class, 'all'])->name('stats.all');
    Route::get('my-stats', [StatController::class, 'my'])->name('stats.my');
});
