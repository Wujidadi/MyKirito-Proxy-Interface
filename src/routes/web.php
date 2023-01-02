<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Forestage\HomeController::class, 'index']);
