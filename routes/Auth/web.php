<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('throttle:6,1')->name('register.store');
    Route::view('/login', 'pages.auth.login')->name('login');
    Route::post('/login', LoginController::class)->middleware('throttle:6,1')->name('login.store');
});

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');
