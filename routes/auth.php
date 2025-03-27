<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Auth Sanctum
////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::post('login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login');


Route::post('register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1')
    ->name('register');


Route::post('logout', [AuthController::class, 'logout'])
    ->middleware(['throttle:5,1', 'auth:sanctum'])
    ->name('logout');

