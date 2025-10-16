<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\ArticleResources;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResources::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
