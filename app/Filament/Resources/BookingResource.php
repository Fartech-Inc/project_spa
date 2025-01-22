<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('booking_code')
                    ->required()
                    ->disabled()
                    ->label('Kode Booking'),
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label('Nama')
                    ->disabled(),
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'name')
                    ->label('Nama Pelayanan')
                    ->disabled(),
                Forms\Components\DatePicker::make('booking_date')
                    ->required()
                    ->label('Tanggal Booking'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_code')->label('Kode Booking')->searchable(),
                Tables\Columns\TextColumn::make('customer.name')->label('Nama')->searchable(),
                Tables\Columns\TextColumn::make('service.name')->label('Nama Pelayanan')->searchable(),
                Tables\Columns\TextColumn::make('booking_date')->label('Tanggal Booking')->date()->sortable(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
