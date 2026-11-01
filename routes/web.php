<?php

use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\Auth\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? view('pages.dashboard') : view('pages.home');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Static paths must precede the projects/{project} resource route.
    Route::get('/projects/manage', [ProjectController::class, 'manage'])->name('projects.manage');
    Route::post('/projects/{project}/visibility', [ProjectController::class, 'toggleVisibility'])->name('projects.visibility');
    Route::post('/projects/{project}/like', [ProjectController::class, 'toggleLike'])->name('projects.like');
    Route::resource('projects', ProjectController::class);

    Route::prefix('admin')->name('admin.')->middleware(EnsureUserIsAdmin::class)->group(function () {
        Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    });
});

require __DIR__.'/Auth/web.php';
