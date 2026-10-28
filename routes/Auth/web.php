<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    Route::get('/login', [RegisteredUserController::class, '']);
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
});
