<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriResource\Pages;
use App\Filament\Resources\MateriResource\RelationManagers;
use App\Models\Materi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Materi';
    protected static ?string $modelLabel = 'Materi';
    protected static ?string $pluralModelLabel = 'Materi';
    protected static ?string $navigationGroup = 'Course';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nama Materi')
                    // ->placeholder('Masukkan nama materi')
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('kode_materi')
                    ->required()
                    ->label('Kode Materi')
                    // ->placeholder('Masukkan kode materi')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                    
                Forms\Components\FileUpload::make('materials') 
                    ->label('Upload File')
                    ->disk('public') // Disk penyimpanan
                    ->directory('pdf-materials') // Direktori file
                    ->preserveFilenames() // Jaga nama file asli
                    ->maxSize(5120) 
                    ->downloadable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Materi')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('kode_materi')
                    ->label('Kode Materi')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('materials')
                    ->label('File Materi')
                    ->searchable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMateris::route('/'),
            'create' => Pages\CreateMateri::route('/create'),
            'edit' => Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}