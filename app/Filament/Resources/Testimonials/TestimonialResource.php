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
    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            // Name always required
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('location')
                ->maxLength(255)
                ->visible(fn($get) => !$get('is_video')),

            // Rating is optional for videos, required for text testimonials (adjust as needed)
            TextInput::make('rating')
                ->label('Rating (1-5)')
                ->numeric()
                ->minValue(1)
                ->maxValue(5)
                ->default(5)
                ->required(fn($get) => !$get('is_video')),
            // Toggle: reactive so dependent fields update instantly
            Toggle::make('is_video')
                ->label('Is Video')
                ->inline(false)
                ->reactive(),
            Select::make('therapy_id')
                ->label('Therapy')
                ->options(fn() => Therapy::orderBy('title')->pluck('title', 'id')->toArray())
                ->searchable()
                ->nullable()
                ->visible(fn($get) => !$get('is_video')),

            // Avatar: optional for both, but hide if you prefer for pure video entries
            FileUpload::make('avatar')
                ->label('Avatar')
                ->image()
                ->directory('testimonials/avatars')
                ->disk('public')
                ->nullable()
                ->visible(fn($get) => !$get('is_video')),

            // Text: only for non-video testimonials; required when not a video
            Textarea::make('text')
                ->rows(4)
                ->required(fn($get) => !$get('is_video'))
                ->visible(fn($get) => !$get('is_video')),



            // Video file: visible + required when is_video = true
            FileUpload::make('video')
                ->label('Video file (mp4/webm)')
                ->directory('testimonials/videos')
                ->disk('public')
                ->maxSize(51200) // 50 MB - adjust as needed
                ->acceptedFileTypes(['video/mp4', 'video/webm'])
                ->nullable()
                ->visible(fn($get) => (bool) $get('is_video'))
                ->required(fn($get) => (bool) $get('is_video')),

            // Video thumbnail: visible + required when is_video = true (optional if you prefer)
            FileUpload::make('video_thumbnail')
                ->label('Video thumbnail (image)')
                ->directory('testimonials/video_thumbs')
                ->disk('public')
                ->image()
                ->nullable()
                ->visible(fn($get) => (bool) $get('is_video'))
                ->required(fn($get) => (bool) $get('is_video')),

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

                // Show therapy title if present
                TextColumn::make('therapy.title')
                    ->label('Therapy')
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable(),

                // New: show whether this is a video testimonial
                TextColumn::make('is_video')
                    ->label('Video?')
                    ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
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
