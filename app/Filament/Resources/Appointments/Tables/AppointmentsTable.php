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
                TextColumn::make('name')->searchable(),
                TextColumn::make('phone'),

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

                TextColumn::make('confirmed_date')
                    ->label('Confirmed Date')
                    ->dateTime()
                    ->sortable()
                    ->formatStateUsing(fn($state, $record) => $record->confirmed_date ?? $record->preferred),

                TextColumn::make('created_at')
                    ->label('Submitted On')
                    ->date(),
            ])
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
