<?php

namespace App\Filament\Resources\PainTechniques\Pages;

use App\Filament\Resources\PainTechniques\PainTechniqueResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditPainTechnique extends EditRecord
{
    protected static string $resource = PainTechniqueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
