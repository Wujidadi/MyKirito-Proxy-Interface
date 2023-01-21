<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => 'jwt'], function () {
    Route::get('get-tokens', [\App\Http\Controllers\Api\TokenController::class, 'getTokens']);
});

Route::group(['prefix' => 'user'], function () {
    Route::post('add', [\App\Http\Controllers\Api\UserController::class, 'add']);
});
