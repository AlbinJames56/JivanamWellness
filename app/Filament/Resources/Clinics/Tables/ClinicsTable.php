<?php

namespace App\Filament\Resources\Clinics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClinicsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->rounded(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('city')->sortable(),
                BooleanColumn::make('is_open')->label('Open'),
                TextColumn::make('created_at')->dateTime('M d, Y'),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
