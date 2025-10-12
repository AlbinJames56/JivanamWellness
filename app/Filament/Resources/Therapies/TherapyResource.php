<?php

namespace App\Filament\Resources\Therapies;

use App\Models\Therapy;
use BackedEnum;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TherapyResource extends Resource
{
    protected static ?string $model = Therapy::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'Therapy';

    public static function form(Schema $schema): Schema
        {
            return $schema->schema([
                TextInput::make('title')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', \Str::slug($state))),
                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Textarea::make('summary')->rows(3),
                RichEditor::make('content')
                    ->toolbarButtons(['bold', 'italic', 'link', 'bulletList', 'orderedList', 'blockquote'])
                    ->nullable(),
                FileUpload::make('image')->image()->directory('therapies')->disk('public')->enableOpen()->nullable(),
                TextInput::make('duration')->placeholder('e.g. 7-21 days'),
                TextInput::make('tag')->placeholder('e.g. Detox, Massage'),
                Toggle::make('featured')->inline(false),
            ]);
        }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->rounded(),
                TextColumn::make('title')->searchable()->limit(40),
                TextColumn::make('tag')->label('Category')->sortable(),
                BooleanColumn::make('featured'),
                TextColumn::make('created_at')->dateTime('M d, Y')->sortable(),
            ])
            ->filters([
                //
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
        return [
            //
        ];
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
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
