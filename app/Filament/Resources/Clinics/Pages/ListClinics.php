<?php

namespace App\Filament\Resources\Clinics\Pages;

use App\Filament\Resources\Clinics\ClinicsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClinics extends ListRecords
{
    protected static string $resource = ClinicsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
