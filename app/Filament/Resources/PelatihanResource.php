<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihanResource\Pages;
use App\Filament\Resources\PelatihanResource\RelationManagers;
use App\Models\Pelatihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Pelatihan';
    protected static ?string $navigationGroup = 'Course';

    public static function getJenisOptions(): array
    {
        return [
            'offline' => 'Offline',
            'online' => 'Online',
            'hybrid' => 'Hybrid',
        ];
    }

    public static function getKesulitanOptions(): array
    {
        return [
            'pemula' => 'Pemula',
            'medium' => 'Menengah',
            'hard' => 'Sulit',
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nama Pelatihan')
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\Select::make('kesulitan')
                    ->options([
                        'pemula' => 'Pemula',
                        'medium' => 'Menengah',
                        'hard' => 'Sulit',
                    ])
                    ->required(),
                Forms\Components\Select::make('jenis')
                    ->options([
                        'offline' => 'Offline',
                        'online' => 'Online',
                        'hybrid' => 'Hybird',
                    ]),
                Forms\Components\Textarea::make('deskripsi')
                    ->required(),
                Forms\Components\TextInput::make('thumbnail')
                    ->required(),
                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->minValue(1)
                    ->prefix('IDR'),
                Forms\Components\TextInput::make('kapasitas')
                    ->numeric()
                    ->minValue(1)
                    ->required()
                    ->prefix('Qty'),
                Forms\Components\Select::make('materi_id')
                    ->relationship('materi', 'name')
                    ->required(),
                // Forms\Components\Select::make('jadwal_id')
                //     ->relationship('jadwalPelatihan', 'name')
                //     ->required(),
                // Forms\Components\TextInput::make('email')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('kesulitan')->label('Kesulitan'),
                Tables\Columns\TextColumn::make('jenis'),
                Tables\Columns\TextColumn::make('harga'),
                Tables\Columns\TextColumn::make('kapasitas'),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPelatihans::route('/'),
            'create' => Pages\CreatePelatihan::route('/create'),
            'edit' => Pages\EditPelatihan::route('/{record}/edit'),
        ];
    }
}