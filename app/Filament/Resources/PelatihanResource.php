<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelatihanResource\Pages;
use App\Models\Pelatihan;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

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
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama Pelatihan')
                ->required(),

            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required(),

            Forms\Components\Select::make('kesulitan')
                ->options([
                    'dasar' => 'Dasar',
                    'medium' => 'Menengah',
                    'hard' => 'Lanjutan',
                ])
                ->required(),

            Forms\Components\Select::make('jenis')
                ->options([
                    'offline' => 'Offline',
                    'online' => 'Online',
                    'hybrid' => 'Hybrid',
                ])
                ->live()
                ->required(),

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
                ->required(fn (Forms\Get $get): bool => $get('jenis') === 'online') // Wajib diisi jika online
                ->visible(fn (Forms\Get $get): bool =>
                    $get('jenis') === 'online' ||
                    $get('jenis') === 'hybrid'
                ) // Hanya tampil jika online atau hybrid
                ->label('Materi'),
                Forms\Components\Select::make('teacher_id')
                ->relationship('teacher', 'name')  // Relasi dengan model Teacher, tampilkan field 'name'
                ->multiple()
                ->relationship('teachers', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('thumbnail'),
            Tables\Columns\TextColumn::make('kesulitan')->label('Kesulitan'),
            Tables\Columns\TextColumn::make('jenis'),
            Tables\Columns\TextColumn::make('harga'),
            Tables\Columns\TextColumn::make('kapasitas'),
            Tables\Columns\TextColumn::make('category.name')->label('Kategori'),
            Tables\Columns\TextColumn::make('teachers.name')
                ->label('pengajar')
                ->separator(', '),
        ])
        ->filters([
            SelectFilter::make('category_id')
                ->relationship('category', 'name')
                ->label('Kategori'),
        ])
        ->actions([
            // Tables\Actions\ViewAction::make()
            //     ->label('View')
            //     ->icon('heroicon-o-eye')
            //     ->modalHeading(fn ($record) => "View {$record->name}")
            //     ->form([
            //         Forms\Components\TextInput::make('name')
            //             ->label('Nama Pelatihan')
            //             ->disabled(),

            //         Forms\Components\TextInput::make('category.name')
            //             ->label('Kategori')
            //             ->disabled(),

            //         Forms\Components\TextInput::make('kesulitan')
            //             ->label('Kesulitan')
            //             ->disabled(),

            //         Forms\Components\TextInput::make('jenis')
            //             ->label('Jenis')
            //             ->disabled(),

            //         Forms\Components\Textarea::make('deskripsi')
            //             ->label('Deskripsi')
            //             ->disabled(),

            //         Forms\Components\TextInput::make('harga')
            //             ->label('Harga')
            //             ->prefix('IDR')
            //             ->disabled(),

            //         Forms\Components\TextInput::make('kapasitas')
            //             ->label('Kapasitas')
            //             ->prefix('Qty')
            //             ->disabled(),

            //         Forms\Components\TextInput::make('thumbnail')
            //             ->label('Thumbnail')
            //             ->disabled(),
            //     ])
            //     ->formActions([  // Using formActions for buttons
            //         Forms\Components\Button::make('Close')
            //             ->label('Tutup')
            //             ->color('secondary'),
            //     ]),

            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelatihans::route('/'),
            'create' => Pages\CreatePelatihan::route('/create'),
            'edit' => Pages\EditPelatihan::route('/{record}/edit'),
            'view' => Pages\ViewPelatihan::route('/{record}'),
        ];
    }
}