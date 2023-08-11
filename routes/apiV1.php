<?php

use App\Helpers\API;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'index']);

    Route::get('/user/{user}', [UserController::class, 'detail'])
        ->missing(fn () => API::notFoundResponse('User not found'));

    Route::patch('/user/{user}', [UserController::class, 'update'])
        ->missing(fn () => API::notFoundResponse('User not found'));

    Route::delete('/user/{user}', [UserController::class, 'delete'])
        ->missing(fn () => API::notFoundResponse('User not found'));
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Service Not Found'
    ]);
}, 404);
