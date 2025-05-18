<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserPelatihanResource\Pages;
use App\Filament\Resources\UserPelatihanResource\RelationManagers;
use App\Models\UserPelatihan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserPelatihanResource extends Resource
{
    protected static ?string $model = UserPelatihan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),
            Forms\Components\Select::make('pelatihan_id')
                ->relationship('pelatihan', 'nama')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                ->label('User Name')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('pelatihan.name')
                ->label('Pelatihan')
                ->searchable()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUserPelatihans::route('/'),
            'create' => Pages\CreateUserPelatihan::route('/create'),
            'edit' => Pages\EditUserPelatihan::route('/{record}/edit'),
        ];
    }
}