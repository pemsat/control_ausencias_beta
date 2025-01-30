<?php

namespace App\Policies;

use App\Models\User;
use App\Models\User_Attendance;

class UserAttendancePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, User_Attendance $attendance)
{
    return now()->diffInMinutes($attendance->created_at) < 10;
}

}
