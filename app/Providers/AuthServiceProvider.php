<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User_Attendance;
use App\Policies\UserAttendancePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User_Attendance::class => UserAttendancePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
