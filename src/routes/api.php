<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/token/verify', [\App\Http\Controllers\AuthController::class, 'me']);

Route::group(['middleware' => 'jwt'], function () {
    Route::get('get-tokens', [\App\Http\Controllers\Api\TokenController::class, 'getTokens']);

    Route::group(['prefix' => 'my-kirito'], function () {
        Route::get('player-info', [\App\Http\Controllers\Api\MyKiritoController::class, 'getPlayerInfo']);
        Route::post('player-status', [\App\Http\Controllers\Api\MyKiritoController::class, 'updatePlayerStatus']);
        Route::post('teammate', [\App\Http\Controllers\Api\MyKiritoController::class, 'setTeammate']);
        Route::post('do-action', [\App\Http\Controllers\Api\MyKiritoController::class, 'doAction']);
        Route::get('achievements', [\App\Http\Controllers\Api\MyKiritoController::class, 'getAchievements']);
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::post('add', [\App\Http\Controllers\Api\UserController::class, 'add']);
});
