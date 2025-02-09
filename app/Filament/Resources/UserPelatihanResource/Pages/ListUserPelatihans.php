<?php

namespace App\Filament\Resources\UserPelatihanResource\Pages;

use App\Filament\Resources\UserPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserPelatihans extends ListRecords
{
    protected static string $resource = UserPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
