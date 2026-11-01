<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    Route::view('/login', 'pages.auth.login')->name('login');

    Route::post('/login', LoginController::class)->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);

    Route::post('/logout', LogoutController::class)->name('logout');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
});
