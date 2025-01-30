<?php

use App\Http\Controllers\PublicAttendanceController;
use App\Models\UserAttendance;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/faltas', [PublicAttendanceController::class, 'index']);

Route::get('/api/attendance-events', function () {
    $attendances = UserAttendance::all(); // Adjust this to filter based on your needs

    return response()->json($attendances->map(function($attendance) {
        return [
            'title' => $attendance->user->name,
            'start' => $attendance->date,
            'end' => $attendance->date,
            'description' => $attendance->description,
        ];
    }));
});


require __DIR__.'/auth.php';
