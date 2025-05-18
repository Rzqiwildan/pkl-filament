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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;

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
                    }),
                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->disk('public')
                    ->width(100)
                    ->height(100),
                ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pembayaran')
                    ->options(Transaksi::getStatuses())
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('view_bukti')
                ->label('Lihat Bukti')
                ->icon('heroicon-o-photo')
                ->modalWidth('md')
                ->modalHeading('Bukti Pembayaran')
                ->modalContent(function (Transaksi $record) {
                    if ($record->bukti_pembayaran) {
                        return new HtmlString('<div class="flex justify-center"><img src="/storage/' . $record->bukti_pembayaran . '" class="max-w-full h-auto"></div>');
                    }
                    return 'Tidak ada bukti pembayaran';
                })
                ->visible(fn (Transaksi $record) => $record->bukti_pembayaran !== null),
            Action::make('accept')
                ->label('Accept')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->action(function (Transaksi $record) {
                    $record->update(['status_pembayaran' => 'approved']);
                    \App\Models\UserPelatihan::create([
                        'user_id' => $record->user_id,
                        'pelatihan_id' => $record->pelatihan_id,
                    ]);
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