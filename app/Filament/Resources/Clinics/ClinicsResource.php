<?php

namespace App\Filament\Resources\Clinics;

use App\Filament\Resources\Clinics\Pages\CreateClinics;
use App\Filament\Resources\Clinics\Pages\EditClinics;
use App\Filament\Resources\Clinics\Pages\ListClinics;
use App\Filament\Resources\Clinics\Schemas\ClinicsForm;
use App\Filament\Resources\Clinics\Tables\ClinicsTable;
use App\Models\Clinics;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClinicsResource extends Resource
{
    protected static ?string $model = Clinics::class;

    // protected static Have not implemented kind undefined yet. $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Clinics';
    protected static ?int $navigationSort = 4;
    public static function form(Schema $schema): Schema
    {
        return ClinicsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClinicsTable::configure($table);
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
            'index' => ListClinics::route('/'),
            'create' => CreateClinics::route('/create'),
            'edit' => EditClinics::route('/{record}/edit'),
        ];
    }
}
