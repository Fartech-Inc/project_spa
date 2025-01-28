<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceGalleryResource\Pages;
use App\Filament\Resources\ServiceGalleryResource\RelationManagers;
use App\Models\ServiceGallery;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceGalleryResource extends Resource
{
    protected static ?string $model = ServiceGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name')
                    ->label('Layanan')
                    ->required()
                    ->reactive() // Memungkinkan untuk memantau perubahan nilai
                    ->afterStateUpdated(function (callable $set) {
                        // Reset nilai is_thumbnail jika service_id berubah
                        $set('is_thumbnail', false);
                    })
                    ->disabledOn('edit'),
                Forms\Components\Radio::make('is_thumbnail')
                    ->label('Is Thumbnail?')
                    ->options([
                        true => 'True',
                        false => 'False',
                    ])
                    ->default(false)
                    ->required()
                    ->hidden(fn(callable $get) => ServiceGallery::where('service_id', $get('service_id'))->where('is_thumbnail', true)->exists()),
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->directory('service-galleries')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_thumbnail')
                    ->label('Is Thumbnail?'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListServiceGalleries::route('/'),
            'create' => Pages\CreateServiceGallery::route('/create'),
            'edit' => Pages\EditServiceGallery::route('/{record}/edit'),
        ];
    }
}
