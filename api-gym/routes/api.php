<?php

use App\Http\Controllers\{AuthController, PlansController, UserController, WorkingOutController};
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class, 'create']);


Route::middleware('jwt.verify', 'isAdmin')->group(function () {

    Route::get('/users', [UserController::class, 'getAll']);
    Route::get('/users/{id}', [UserController::class, 'getOne']);
    Route::patch('/users/{id}', [UserController::class, 'patch']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);

    Route::post('/working-out', [WorkingOutController::class, 'create']);
    Route::delete('/working-out/{id}', [WorkingOutController::class, 'delete']);


    Route::post('/plans', [PlansController::class, 'create']);
    Route::get('/plans', [PlansController::class, 'getAll']);
    Route::get('/plans/{id}', [PlansController::class, 'getOne']);
    Route::patch('/plans/{id}', [PlansController::class, 'patch']);
    Route::delete('/plans/{id}', [PlansController::class, 'delete']);
});
