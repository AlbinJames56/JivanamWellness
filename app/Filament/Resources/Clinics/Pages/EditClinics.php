<?php

namespace App\Filament\Resources\Clinics\Pages;

use App\Filament\Resources\Clinics\ClinicsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClinics extends EditRecord
{
    protected static string $resource = ClinicsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
