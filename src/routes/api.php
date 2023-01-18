<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-tokens', [\App\Http\Controllers\Api\TokenController::class, 'getTokens']);

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::group(['prefix' => 'user'], function () {
    Route::post('add', [\App\Http\Controllers\Api\UserController::class, 'add']);
});
