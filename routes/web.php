<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth('web')->check()) {
        return view('pages.dashboard');
    }

    return view('pages.home');
})->name('home');

Route::resource('projects', ProjectController::class);
