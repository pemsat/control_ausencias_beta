<?php

namespace App\Filament\Widgets;

use App\Models\UserAttendance;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = UserAttendance::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return UserAttendance::where('start', '>=', $fetchInfo['start'])
            ->where('end', '<=', $fetchInfo['end'])
            ->get()
            ->map(function (UserAttendance $attendance) {
                return [
                    'id'    => $attendance->id,
                    'title' => $attendance->user->name,
                    'start' => $attendance->start->toIso8601String(),
                    'end'   => $attendance->end->toIso8601String(),
                ];
            })
            ->toArray();
    }

    public static function canView(): bool
    {
        return true;  // Ensure the widget can be viewed
    }
}