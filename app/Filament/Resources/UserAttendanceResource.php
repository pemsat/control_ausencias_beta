<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserAttendanceResource\Pages;
use App\Filament\Resources\UserAttendanceResource\RelationManagers;
use App\Filament\Widgets\CalendarWidget;
use App\Models\UserAttendance;
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
use Filament\Forms\Components\Textarea;

class UserAttendanceResource extends Resource
{
    protected static ?string $model = UserAttendance::class;

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
                    ->multiple()
                    ->options([
                        '08:00' => '08:00 - 08:55',
                        '08:55' => '08:55 - 09:50',
                        '09:50' => '09:50 - 10:45',
                        '11:15' => '11:15 - 12:10',
                        '12:10' => '12:10 - 13:05',
                        '13:05' => '13:05 - 14:00',
                    ]),


                // Horario de la tarde
                Select::make('afternoon_hours')
                    ->label('Hora de la tarde')
                    ->multiple()
                    ->options(self::getAfternoonHours()),
                Textarea::make('comment')
                    ->label('Motivo')
                    ->rows(3)
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
                '15:00' => '15:00 - 15:45', // Comienza más tarde
                '15:45' => '15:45 - 16:30',
                '16:30' => '16:30 - 17:15',
                '17:45' => '17:45 - 18:30',
                '18:30' => '18:30 - 19:15',
                '19:15' => '19:15 - 20:00',
            ];
        }

        // Para los demás días, usamos el horario regular
        return [
            '14:00' => '14:00 - 14:55',
            '14:55' => '14:55 - 15:50',
            '15:50' => '15:50 - 16:45',
            '17:15' => '17:15 - 18:10',
            '18:10' => '18:10 - 19:05',
            '19:05' => '19:05 - 20:00',
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CalendarWidget::class,
        ];
    }
}
