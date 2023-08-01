<?php

use App\Http\Controllers\{AuthController, PlansController, UserController};
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class, 'create']);

Route::middleware('jwt.verify')->group(function () {
    Route::post('/plans', [PlansController::class, 'create']);
});
