<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiResource\Pages;
use App\Filament\Resources\TransaksiResource\RelationManagers;
use App\Models\Transaksi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Payment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('pelatihan_id')
                    ->relationship('pelatihan', 'name')
                    ->required(),
                Forms\Components\Select::make('status_pembayaran')
                    ->options(Transaksi::getStatuses())
                    ->default('pending')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pelatihan.name')
                    ->label('Pelatihan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        default => 'gray',
                    })
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->options(Transaksi::getStatuses())
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('accept')
                    ->label('Accept')
                    ->color('success')
                    ->icon('heroicon-o-check-circle')
                    ->action(function (Transaksi $record) {
                        $record->update(['status_pembayaran' => 'approved']);
                    })
                    ->visible(fn (Transaksi $record) => $record->status_pembayaran === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Terima Transaksi')
                    ->modalDescription('Apakah Anda yakin ingin menerima transaksi ini?')
                    ->modalSubmitActionLabel('Ya, Terima'),
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
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}