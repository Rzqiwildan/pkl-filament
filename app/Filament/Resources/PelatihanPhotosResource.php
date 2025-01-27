<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihanPhotosResource\Pages;
use App\Models\PelatihanPhotos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelatihanPhotosResource extends Resource
{
    protected static ?string $model = PelatihanPhotos::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Manajemen Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->directory('pelatihan-photos') // Folder penyimpanan
                    ->required(),
                Forms\Components\Select::make('pelatihan_id')
                    ->label('Nama Pelatihan') // Label untuk dropdown
                    ->relationship('pelatihan', 'name') // Relasi ke model Pelatihan
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo')
                    ->circular(),
                Tables\Columns\TextColumn::make('pelatihan.id')
                    ->label('Pelatihan')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relation managers jika ada relasi tambahan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelatihanPhotos::route('/'),
            'create' => Pages\CreatePelatihanPhotos::route('/create'),
            'edit' => Pages\EditPelatihanPhotos::route('/{record}/edit'),
        ];
    }
}