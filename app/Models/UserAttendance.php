<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'time', 
        'date', 
        'comment'
    ];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
