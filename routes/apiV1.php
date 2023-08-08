<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;

Route::post('/login', [LoginController::class, 'login']);

Route::fallback(function () {
    return response()->json([
        'message' => 'Service Not Found'
    ]);
}, 404);
