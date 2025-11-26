<?php

namespace App\Filament\Resources\PainTechniques;

use App\Models\PainTechnique;
use BackedEnum;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PainTechniqueResource extends Resource
{
    protected static ?string $model = PainTechnique::class;

    // protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationLabel = 'Pain Techniques';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([

            Section::make('Pain Technique Details')->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', \Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
            ])->columns(2),
            Section::make(' ')->schema([
                Forms\Components\FileUpload::make('image')->image()->directory('pain-techniques')->disk('public'),
                Forms\Components\RichEditor::make('more_info')->nullable(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TagsInput::make('benefits')
                    ->label('Benefits')
                    ->placeholder('Add a benefit and press Enter')
                    // cap at 5
                    ->required(false)
                    ->reactive()
                    ->columnSpan('full'),
            ])->columns(1),
            Section::make(' ')->schema([

                Forms\Components\TextInput::make('duration')->placeholder('e.g. 30–60 min'),
                Forms\Components\TextInput::make('price')->numeric()->nullable(),
                Forms\Components\TextInput::make('price_currency')->default('INR')->maxLength(4)->nullable(),
                
            ])->columns(2),
        ])->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->disk('public')->rounded(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                 
                Tables\Columns\BooleanColumn::make('featured'),
                Tables\Columns\BooleanColumn::make('available'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M d, Y'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPainTechniques::route('/'),
            'create' => Pages\CreatePainTechnique::route('/create'),
            'edit' => Pages\EditPainTechnique::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
