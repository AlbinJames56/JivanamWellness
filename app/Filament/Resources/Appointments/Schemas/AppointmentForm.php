<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('booked_at')
                    ->label('Booked at')
                    ->disabled(),

                TextInput::make('name')->required()->disabled(),
                TextInput::make('phone')->required()->disabled(),
                TextInput::make('email')->disabled(),
                Select::make('therapy_id')
                    ->relationship('therapy', 'title')
                    ->searchable()->disabled(),
                Select::make('clinic_id')
                    ->label('Clinic / Location')
                    ->relationship('clinic', 'name')
                    ->searchable()
                    ->placeholder('Select clinic (optional)'),
                // preferred appointment date/time
                DateTimePicker::make('preferred')
                    ->label('Preferred date & time')
                    ->reactive() // so we can react to changes
                    ->afterStateUpdated(function ($state, callable $set, $get) {
                        // If confirmed_date is empty (i.e. not set by admin yet),
                        // keep it synchronized with preferred. If admin already set
                        // confirmed_date, do not overwrite it.
                        if (empty($get('confirmed_date'))) {
                            $set('confirmed_date', $state);
                        }
                    })->disabled(),

                Textarea::make('notes')->disabled(),

                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'rescheduled' => 'Rescheduled',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->default('pending'),

                // confirmed_date defaults to preferred (for create),
                // and remains editable for admin to change.
                DateTimePicker::make('confirmed_date')
                    ->label('Confirmed date & time')
                    ->reactive()
                    ->default(fn(callable $get) => $get('preferred')),
            ]);
    }
}
