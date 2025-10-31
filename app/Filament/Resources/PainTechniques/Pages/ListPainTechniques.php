<?php

namespace App\Filament\Resources\PainTechniques\Pages;

use App\Filament\Resources\PainTechniques\PainTechniqueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPainTechniques extends ListRecords
{
    protected static string $resource = PainTechniqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
