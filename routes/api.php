<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Tasks
////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('tasks')->group(function () {

    Route::get('/', [TaskController::class, 'index'])
        ->middleware(['auth:sanctum'])
        ->name('tasks.index');


    Route::get('/{task}', [TaskController::class, 'show'])
        ->middleware(['auth:sanctum'])
        ->can('access-task', 'task')
        ->name('tasks.show');


    Route::post('/store', [TaskController::class, 'store'])
        ->middleware(['auth:sanctum'])
        ->name('tasks.store');


    Route::put('/update/{task}', [TaskController::class, 'update'])
        ->middleware(['auth:sanctum'])
        ->can('access-task', 'task')
        ->name('tasks.update');


});
