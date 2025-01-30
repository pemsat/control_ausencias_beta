<?php

namespace App\Http\Controllers;

use App\Models\User_Attendance;
use Illuminate\Http\Request;

class PublicAttendanceController extends Controller
{
    public function index()
    {
        $currentTimeSlot = now()->format('H:i');
        $attendances = User_Attendance::where('time_slot', 'LIKE', "%$currentTimeSlot%")
            ->where('date', today()->toDateString())
            ->with('user.department')
            ->get();

        return view('attendances.index', compact('attendances'));
    }
}
