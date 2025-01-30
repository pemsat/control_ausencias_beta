<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserAttendance;

class UserAttendancePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, UserAttendance $attendance)
{
    return now()->diffInMinutes($attendance->created_at) < 10;
}

}
