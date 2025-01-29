<?php

namespace App\Filament\Resources\PelatihanPhotosResource\Pages;

use App\Filament\Resources\PelatihanPhotosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelatihanPhotos extends ListRecords
{
    protected static string $resource = PelatihanPhotosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
