<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Product';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_category_id')
                    ->relationship('product_category', 'name')
                    ->label('Category')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required(),
                // Forms\Components\TextInput::make('description')
                //     ->label('Description')
                //     ->required(),
                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->required(),
                // Forms\Components\TextInput::make('weight')
                //     ->label('Weight')
                //     ->required(),
                Forms\Components\FileUpload::make('image')
    ->disk('public')
    ->directory('products')
    ->visibility('public'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_category.name')
                    ->label('Category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price'),
                // Tables\Columns\TextColumn::make('description')
                //     ->label('Description'),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock'),
                // Tables\Columns\TextColumn::make('weight')
                //     ->label('Weight'),
              Tables\Columns\ImageColumn::make('image')
    ->label('Image')
    ->disk('public')
    ->visibility('public')
    ->url(fn ($record) => str_replace('storage/public/', 'storage/', Storage::disk('public')->url($record->image))),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
