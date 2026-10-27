<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth('web')->check()) {
        return view('pages.dashboard');
    }

    return view('pages.home');
})->name('home');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.store');


Route::resource('projects', ProjectController::class);
