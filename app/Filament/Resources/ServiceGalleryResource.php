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
                Forms\Components\TextInput::make('service_id')
                    ->relationship('service', 'name')
                    ->label('Layanan')
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('image')
                    ->label('Gambar')
                    ->required()
                    ->image()
                    ->imageWidth(200)
                    ->imageHeight(200),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Layanan')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->imageWidth(50)
                    ->imageHeight(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->searchable(),
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
