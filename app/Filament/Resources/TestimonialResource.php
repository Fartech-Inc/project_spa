<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\RelationManagers;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Testimonial';

    protected static ?string $navigationGroup = 'Testimonial Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('service_id')
                    ->relationship('service', 'name')
                    ->label('Service')
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('transaction_id')
                    ->relationship('transaction', 'code')
                    ->label('Transaction')
                    ->required()
                    ->disabled(),
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Nama')
                    ->disabled(),
                Forms\Components\TextArea::make('message')
                    ->label('Message')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->maxValue(5)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('service.name')
                    ->label('Service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transaction.code')
                    ->label('Transaction')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('message')->label('Message'),
                Tables\Columns\TextColumn::make('rating')->label('Rating'),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal Dibuat')->sortable(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
