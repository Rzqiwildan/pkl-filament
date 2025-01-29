<?php

namespace App\Filament\Resources\PelatihanPhotosResource\Pages;

use App\Filament\Resources\PelatihanPhotosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelatihanPhotos extends EditRecord
{
    protected static string $resource = PelatihanPhotosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
