<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\ArticleResources;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResources::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
