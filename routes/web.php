<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;

Route::get('/', fn () => inertia('Welcome', [
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
]))->name('welcome');

Route::middleware('auth')->group(function () {
    Route::inertia('/dashboard', 'Dashboard')
        ->name('dashboard');

    Route::get('/list-users', [UserController::class, 'users'])
        ->name('users');

    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');

    Route::post('/profile', [UserController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile/remove', [UserController::class, 'destroy'])
        ->name('profile.delete');
});

require __DIR__ . '/auth.php';
