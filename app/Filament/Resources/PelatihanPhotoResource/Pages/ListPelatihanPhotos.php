<?php

namespace App\Filament\Resources\PelatihanPhotoResource\Pages;

use App\Filament\Resources\PelatihanPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPelatihanPhotos extends ListRecords
{
    protected static string $resource = PelatihanPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
