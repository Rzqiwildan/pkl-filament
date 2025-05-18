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
use Filament\Notifications\Notification;

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
                ->options(self::getJenisOptions())
                ->live() // Memastikan form merespon perubahan langsung
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
            Tables\Columns\TextColumn::make('jenis')
            ->badge()
            ->color(fn (string $state): string => match ($state) {
                'online' => 'success',
                'offline' => 'warning',
                default => 'primary',
            }),
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
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make()
                ->before(function (Tables\Actions\DeleteAction $action, Pelatihan $record) {
                    // Cek apakah pelatihan memiliki photos (PelatihanPhotos)
                    if ($record->photos()->count() > 0) {
                        // Batalkan penghapusan dengan notifikasi error
                        Notification::make()
                            ->title('Penghapusan ditolak')
                            ->body('Tidak dapat menghapus pelatihan karena masih terdapat foto pelatihan yang terkait. Hapus semua foto pelatihan terlebih dahulu.')
                            ->danger()
                            ->send();
                            
                        // Hentikan proses delete dengan benar
                        $action->halt();
                    }
                }),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make()
                ->before(function (Tables\Actions\DeleteBulkAction $action, \Illuminate\Database\Eloquent\Collection $records) {
                    // Periksa setiap pelatihan yang akan dihapus
                    foreach ($records as $record) {
                        if ($record->photos()->count() > 0) {
                            // Batalkan penghapusan dengan notifikasi error
                            Notification::make()
                                ->title('Penghapusan ditolak')
                                ->body('Beberapa pelatihan tidak dapat dihapus karena masih memiliki foto pelatihan yang terkait. Hapus semua foto pelatihan terlebih dahulu.')
                                ->danger()
                                ->send();
                                
                            // Hentikan proses delete dengan benar
                            $action->halt();
                            return false;
                        }
                    }
                }),
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