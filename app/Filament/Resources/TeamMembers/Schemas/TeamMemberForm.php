<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('title')->maxLength(255),
                TextInput::make('specialization')->maxLength(255),
                TextInput::make('experience')
                    ->maxLength(80)
                    ->helperText('e.g. "15+ years"'),
                Textarea::make('bio')->rows(5),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('team')
                    ->nullable(),
                Toggle::make('featured')->inline(false),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('active')->default(true),
            ])
            ->columns(1);
    }
}
