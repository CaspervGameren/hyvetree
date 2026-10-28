<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth('web')->check()) {
        return view('pages.dashboard');
    }

    return view('pages.home');
})->name('home');

require __DIR__ . '/Auth/web.php';
