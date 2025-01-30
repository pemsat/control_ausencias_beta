<?php

use App\Http\Controllers\PublicAttendanceController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/faltas', [PublicAttendanceController::class, 'index']);


require __DIR__.'/auth.php';
