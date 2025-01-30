<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserAttendanceResource\Pages;
use App\Filament\Resources\UserAttendanceResource\RelationManagers;
use App\Models\User_Attendance;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Policies\UserAttendancePolicy;
use Filament\Forms\Components\DateTimePicker;

class UserAttendanceResource extends Resource
{
    protected static ?string $model = User_Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';



    public static function canEdit($record): bool
    {
        return (new UserAttendancePolicy)->update(auth()->user(), $record);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Selección de fecha
                DateTimePicker::make('date')
                    ->label('Fecha')
                    ->required(),

                // Horario de la mañana (común para todos los días)
                Select::make('morning_hours')
                    ->label('Hora de la mañana')
                    ->options([
                        '08:00' => '08:00',
                        '09:00' => '09:00',
                        '10:00' => '10:00',
                        '11:00' => '11:00',
                        '12:00' => '12:00',
                    ])
                    ->required(),

                // Horario de la tarde
                Select::make('afternoon_hours')
                    ->label('Hora de la tarde')
                    ->options(self::getAfternoonHours())
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserAttendances::route('/'),
            'create' => Pages\CreateUserAttendance::route('/create'),
            'edit' => Pages\EditUserAttendance::route('/{record}/edit'),
        ];
    }

    public static function getAfternoonHours()
    {
        // Obtenemos el día de la semana (0 - 6)
        $dayOfWeek = now()->dayOfWeek;

        // Si es martes (día 2), ajustamos las horas de la tarde
        if ($dayOfWeek === 2) { // Martes
            return [
                '15:00' => '15:00', // Comienza más tarde
                '16:00' => '16:00',
                '17:00' => '17:00',
            ];
        }

        // Para los demás días, usamos el horario regular
        return [
            '14:00' => '14:00',
            '15:00' => '15:00',
            '16:00' => '16:00',
            '17:00' => '17:00',
        ];
    }
}
