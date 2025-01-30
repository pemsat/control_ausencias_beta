<?php

namespace App\Filament\Resources\UserAttendanceResource\Pages;

use App\Filament\Resources\UserAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserAttendances extends ListRecords
{
    protected static string $resource = UserAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
