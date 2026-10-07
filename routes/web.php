<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about-us', function () {
    $company = 'Hogeschool Rotterdam';
    // return view('about', compact('text')
    // );
    return view('about', compact('company'));
})->name('about');

Route::get('projects/{name}', function (string $name) {
    $projects = [
        'hyvetree' => [
            'id' => 1,
            'name' => 'Hyvetree',
        ],
        'sportcentrumspijkenisse' => [
            'id' => 1,
            'name' => 'Unfinished',
        ]
    ];

    $project = $projects['name'];

    return view('projects.' . $name, [
        'project' => $project
    ]);
    
});

// Laravel Breeze, no touchy
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
