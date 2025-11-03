<?php

namespace App\Filament\Resources\Therapies;

use App\Models\Therapy;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
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
            Section::make('Therapy Details')
                ->schema([
                    Grid::make(2)->schema([
                        Forms\Components\TextInput::make('title')->required()->columnSpan(1), Forms\Components\Toggle::make('available')->columnSpan(1),
                        Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->columnSpan(1),

                        Forms\Components\TextInput::make('duration')->placeholder('e.g. 7-21 days')->columnSpan(1),
                        Forms\Components\TextInput::make('tag')->placeholder('e.g. Detox, Massage')->columnSpan(1),

                        Forms\Components\Textarea::make('summary')->rows(3)->columnSpan(1),
                        Forms\Components\Textarea::make('excerpt')->rows(2)->maxLength(255)->columnSpan(1),
                        RichEditor::make('content')
                        ->nullable()
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('therapies/attachments')
                        ->fileAttachmentsVisibility('public')
                        ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->nullable()
                            ->directory('therapies')
                            ->disk('public')
                            ->columnSpan(1),

                        Forms\Components\FileUpload::make('gallery')
                            ->multiple()
                            ->nullable()
                            ->image()
                            ->directory('therapies')
                            ->disk('public')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('price')->numeric()->columnSpan(1),
                        Forms\Components\TextInput::make('price_currency')->default('INR')->maxLength(4)->columnSpan(1),

                       

                        Forms\Components\TextInput::make('meta_title')->maxLength(70)->columnSpan(1),
                        Forms\Components\Textarea::make('meta_description')->rows(3)->maxLength(160)->columnSpan(1),
                    ]),

                    
                ])->columnSpan(2)
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
