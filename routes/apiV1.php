<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
});





Route::fallback(function () {
    return response()->json([
        'message' => 'Service Not Found'
    ]);
}, 404);
