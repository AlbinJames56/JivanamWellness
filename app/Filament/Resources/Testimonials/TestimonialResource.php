<?php

namespace App\Filament\Resources\Testimonials;
use App\Models\Therapy;
use Filament\Navigation\NavigationGroup;
use App\Models\Testimonial;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Filament\Support\Icons\Heroicon;
class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationLabel = 'Testimonials';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('location')->maxLength(255),
            TextInput::make('rating')
                ->label('Rating (1-5)')
                ->numeric()
                ->minValue(1)
                ->maxValue(5)
                ->default(5),
            Select::make('therapy_id')
                ->label('Therapy')
                ->options(
                    fn() => Therapy::orderBy('title')
                        ->pluck('title', 'id')
                        ->toArray()
                )
                ->searchable()
                ->nullable(),
            FileUpload::make('avatar')
                ->label('Avatar')
                ->image()
                ->directory('testimonials')
                ->disk('public')
                ->nullable(),
            Textarea::make('text')
                ->rows(4)
                ->required(),
            Toggle::make('featured')->inline(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->rounded()
                    ->label('Avatar'),
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('therapy.title')
                    ->label('Therapy')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([EditAction::make(), DeleteBulkAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletes::class,
        ]);
    }
}
