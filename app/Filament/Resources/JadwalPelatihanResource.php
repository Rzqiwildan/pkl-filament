<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalPelatihanResource\Pages;
use App\Filament\Resources\JadwalPelatihanResource\RelationManagers;
use App\Models\JadwalPelatihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\DateFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalPelatihanResource extends Resource
{
    protected static ?string $model = JadwalPelatihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Jadwal Pelatihan';
    protected static ?string $modelLabel = 'Jadwal Pelatihan';
    protected static ?string $pluralModelLabel = 'Jadwal Pelatihan';
    protected static ?string $navigationGroup = 'Course';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pelatihan_id')
                ->relationship('pelatihan', 'name')
                ->required()
                ->searchable()
                ->preload()
                ->label('Nama Pelatihan')
                ->reactive()
                ->afterStateUpdated(fn ($state, callable $set) => 
                    $set('pelatihan_jenis', \App\Models\Pelatihan::find($state)?->jenis)
                ),

            Forms\Components\Hidden::make('pelatihan_jenis')
                ->default(''),

            Forms\Components\DatePicker::make('start_date')
                ->required()
                ->label('Tanggal Mulai'),
                
            Forms\Components\DatePicker::make('end_date')
                ->required()
                ->label('Tanggal Selesai')
                ->afterOrEqual('start_date'),

            Forms\Components\TextInput::make('location_name')
                ->required()
                ->maxLength(255)
                ->label('Lokasi')
                ->hidden(fn (callable $get) => $get('pelatihan_jenis') === 'online'), // Sembunyikan jika online

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('jadwal-pelatihan')
                ->maxSize(5120)
                ->label('Gambar'),

            Forms\Components\FileUpload::make('jadwal') 
                ->label('Upload Jadwal')
                ->disk('public')
                ->directory('pdf-materials')
                ->maxSize(5120) 
                ->downloadable(),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('pelatihan.name')
                ->searchable()
                ->sortable()
                ->label('Nama Pelatihan'),
                
            Tables\Columns\TextColumn::make('start_date')
                ->date()
                ->sortable()
                ->label('Tanggal Mulai'),
                
            Tables\Columns\TextColumn::make('end_date')
                ->date()
                ->sortable()
                ->label('Tanggal Selesai'),
                
            Tables\Columns\TextColumn::make('location_name')
                ->searchable()
                ->sortable()
                ->label('Lokasi'),
                
            Tables\Columns\ImageColumn::make('image')
                ->square()
                ->label('Gambar'),
            Tables\Columns\ImageColumn::make('jadwal')
                ->square()
                ->label('jadwal'),
            ])
            ->defaultSort('start_date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('pelatihan')
                ->relationship('pelatihan', 'name')
                ->searchable()
                ->preload()
                ->label('Filter Pelatihan'),
                
                // Tables\Filters\DateFilter::make('start_date')
                // ->label('Filter Tanggal Mulai'),
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
            'index' => Pages\ListJadwalPelatihans::route('/'),
            'create' => Pages\CreateJadwalPelatihan::route('/create'),
            'edit' => Pages\EditJadwalPelatihan::route('/{record}/edit'),
        ];
    }
}