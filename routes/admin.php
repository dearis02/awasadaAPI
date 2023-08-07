<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login-2', function () { // remove this route if you don't need it
    return inertia('admin.auth.login-2');
})->name('login-2');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return inertia('admin.dashboard.index');
    })->name('dashboard');

    // remove this route if you don't need it
    require_once __DIR__.'/component.php';
});
