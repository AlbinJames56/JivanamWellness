<?php

namespace App\Filament\Resources\Clinics\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClinicsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // Section 1: Clinic details / media
                Section::make('Clinic Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->maxLength(255)
                            ->hint('Optional, auto generated from name')
                            ->nullable(),

                        TextInput::make('city')->required(),

                        TextInput::make('hours')
                            ->label('Opening hours')
                            ->nullable(),
                    ])
                    ->columns(2),
                Section::make('Clinic Details')
                    ->schema([
                        Textarea::make('address')
                            ->rows(3)
                            ->nullable(),

                        FileUpload::make('image')
                            ->image()
                            ->disk('public')
                            ->directory('clinics')
                            ->nullable(),
                    ])
                    ->columns(1),
                // Section 2: specialties, toggles and location
                Section::make('Location & Settings')
                    ->schema([
                        Repeater::make('specialties')
                            ->schema([
                                TextInput::make('value')
                                    ->label('Specialty')
                                    ->required(),
                            ])
                            ->createItemButtonLabel('Add specialty')
                            ->columnSpan('full'),

                        TextInput::make('latitude')
                            ->numeric()
                            ->nullable()
                            ->hint('Optional, decimal degrees'),

                        TextInput::make('longitude')
                            ->numeric()
                            ->nullable()
                            ->hint('Optional, decimal degrees'),
                        Toggle::make('is_open')
                            ->label('Open now')
                            ->inline(false),
                    ])
                    ->columns(2),
            ])
            ->columns(1);
    }
}
