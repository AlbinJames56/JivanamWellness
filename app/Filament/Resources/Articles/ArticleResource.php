<?php

namespace App\Filament\Resources\Articles;

use App\Models\Article;
use Filament\Resources\Resource;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationLabel = 'Articles';
    protected static ?int $navigationSort = 6; 
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Article Details')->schema([
                Forms\Components\TextInput::make('title')->required()->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
 Forms\Components\TextInput::make('category')
                    ->placeholder('e.g. Treatments, Nutrition')
                    ->hint('Optional category for filters'), Forms\Components\Toggle::make('published')->default(true),
 ])->columns(2),
Section::make(' ')->schema([
                Forms\Components\Textarea::make('excerpt')->rows(3),
                Forms\Components\RichEditor::make('content')->nullable(),
                Forms\Components\FileUpload::make('image')->image()->directory('articles')->disk('public')->nullable(),
 ])->columns(1),
Section::make('Author & Meta')->schema([
                Forms\Components\TextInput::make('author_name')->label('Author name')->nullable(),
                Forms\Components\FileUpload::make('author_avatar')
                    ->image()
                    ->directory('authors')
                    ->disk('public')
                    ->nullable()
                    ->label('Author avatar'),
                Forms\Components\Textarea::make('author_bio')->rows(2)->label('Author bio')->nullable(),
                Forms\Components\Textarea::make('author_note')->rows(2)->label('Author note')->nullable(),
                Forms\Components\TextInput::make('read_time')->numeric()->label('Read time (min)')->nullable(),
                Forms\Components\DateTimePicker::make('published_at')->label('Publish date')->nullable(),

            ])->columns(2),
        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')->rounded()->label('Thumb'),
            Tables\Columns\TextColumn::make('title')->searchable()->wrap(),
Tables\Columns\TextColumn::make('category')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('excerpt')->limit(60),
            Tables\Columns\BooleanColumn::make('published'),
            Tables\Columns\TextColumn::make('published_at')->dateTime(),
            Tables\Columns\TextColumn::make('created_at')->dateTime('M d, Y'),
        ])->filters([
            Tables\Filters\SelectFilter::make('category')
                ->options(fn () => Article::query()
                    ->pluck('category')
                    ->filter()
                    ->unique()
                    ->values()
                    ->mapWithKeys(fn($v) => [$v => $v])
                    ->toArray()),
            Tables\Filters\TrashedFilter::make(),
        ])->actions([EditAction::make()])
          ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        // Point to pages under this Articles namespace
        return [
            'index'  => \App\Filament\Resources\Articles\Pages\ListArticles::route('/'),
            'create' => \App\Filament\Resources\Articles\Pages\CreateArticle::route('/create'),
            'edit'   => \App\Filament\Resources\Articles\Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
