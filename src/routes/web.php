<?php

use Illuminate\Support\Facades\Route;

Route::get('/{path}', [\App\Http\Controllers\Forestage\HomeController::class, 'index'])
    ->where('path', '^((?!api).)*$');
