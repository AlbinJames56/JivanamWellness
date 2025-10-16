<?php

namespace App\Filament\Resources\Therapies;

use App\Models\Therapy;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TherapyResource extends Resource
{
    protected static ?string $model = Therapy::class;

    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Therapy Details')->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('duration')->placeholder('e.g. 7-21 days'),
                Forms\Components\TextInput::make('tag')->placeholder('e.g. Detox, Massage'),
                Forms\Components\Textarea::make('summary')->rows(3),
                Forms\Components\Textarea::make('excerpt')->rows(2)->maxLength(255),
            ]),



            Section::make('Media & Pricing')->schema([
                Forms\Components\FileUpload::make('image')->image()->nullable()->directory( 'therapies')
                ->disk('public'),
                Forms\Components\FileUpload::make('gallery')
                ->multiple()
                ->nullable()
                ->image()
                ->directory('therapies')
                ->disk('public'),
                Forms\Components\TextInput::make('price')->numeric(),
                Forms\Components\TextInput::make('price_currency')->default('INR')->maxLength(4),
                Forms\Components\Toggle::make('available'),
            ]),

            Section::make('Meta')->schema([
                Forms\Components\TextInput::make('meta_title')->maxLength(70),
                Forms\Components\Textarea::make('meta_description')->rows(3)->maxLength(160),
            ]),
            Section::make('Content')->schema([
                Forms\Components\RichEditor::make('content')->nullable(),
            ]),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
                Tables\Columns\ImageColumn::make('image')->rounded(),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('tag')->label('Category')->sortable(),
                Tables\Columns\BooleanColumn::make('featured'),
                Tables\Columns\TextColumn::make('created_at')->dateTime('M d, Y'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
      return [
          'index' => Pages\ListTherapies::route('/'),
          'create' => Pages\CreateTherapy::route('/create'),
          'edit' => Pages\EditTherapy::route('/{record}/edit'),
      ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
