<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booked_at')->dateTime()->label('Booked at')->sortable(),
                TextColumn::make('name')->searchable(),
                TextColumn::make('phone'),
                TextColumn::make('clinic.name')->label('Clinic')->sortable()->searchable(),
                TextColumn::make('therapy.title')->label('Therapy')->sortable()->searchable(),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'rescheduled' => 'Rescheduled',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->sortable()
                    ->searchable(),

                TextColumn::make('preferred')
                    ->label('Preferred Date')
                    ->dateTime()
                    ->sortable(),

                
                TextColumn::make('created_at')
                    ->label('Submitted On')
                    ->date(),
            ])
            ->defaultSort('booked_at', 'desc')
            ->recordActions([
                EditAction::make(),
            ])
            
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
