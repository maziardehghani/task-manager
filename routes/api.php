<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\TaskOwnershipCheck;
use Illuminate\Support\Facades\Route;


////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Tasks
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('tasks')->group(function () {

    Route::get('/', [TaskController::class, 'index'])
    ->middleware(['auth:sanctum'])
    ->name('tasks.index');


    Route::post('/store', [TaskController::class, 'store'])
        ->middleware(['auth:sanctum'])
        ->name('tasks.store');


    Route::put('/update/{task}', [TaskController::class, 'update'])
        ->middleware(['auth:sanctum'])
        ->can('access-task', 'task')
        ->name('tasks.update');



});






////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Auth
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('auth')->group(function () {


    Route::post('login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login');



    Route::post('register', [AuthController::class, 'register'])
        ->middleware('throttle:5,1')
        ->name('register');;

});
