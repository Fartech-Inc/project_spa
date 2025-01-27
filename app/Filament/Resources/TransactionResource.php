<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required(),
                Forms\Components\TextInput::make('user_id')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('service_id')
                    ->relationship('service', 'name')
                    ->label('Service')
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'cancel' => 'Cancel',
                    ]),
                Forms\Components\Select::make('payment_type')
                    ->label('Payment Type')
                    ->required()
                    ->options([
                        'full_payment' => 'Full Payment',
                        'down_payment' => 'Down Payment',
                    ]),
                Forms\Components\DateTimePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->required()
                    ->disabled(),
                Forms\Components\TimePicker::make('start_time')
                    ->label('Start Time')
                    ->required()
                    ->disabled(),
                Forms\Components\TimePicker::make('end_time')
                    ->label('End Time')
                    ->required()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')->label('Code')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->searchable(),
                Tables\Columns\TextColumn::make('service.name')->label('Service')->searchable(),
                Tables\Columns\TextColumn::make('total_price')->label('Total Price'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge(function ($value) {
                        return match ($value) {
                            'pending' => 'warning',
                            'success' => 'success',
                            'cancel' => 'danger',
                        };
                    })
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Success',
                        'cancel' => 'Cancel',
                    ]),
                Tables\Columns\TextColumn::make('payment_type')
                    ->label('Payment Type')
                    ->options([
                        'full_payment' => 'Full Payment',
                        'down_payment' => 'Down Payment',
                    ]),
                Tables\Columns\TextColumn::make('transaction_date')->label('Transaction Date'),
                Tables\Columns\TextColumn::make('start_time')->label('Start Time'),
                Tables\Columns\TextColumn::make('end_time')->label('End Time'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At'),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
