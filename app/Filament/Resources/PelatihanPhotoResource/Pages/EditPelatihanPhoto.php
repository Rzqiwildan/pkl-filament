<?php

namespace App\Filament\Resources\PelatihanPhotoResource\Pages;

use App\Filament\Resources\PelatihanPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPelatihanPhoto extends EditRecord
{
    protected static string $resource = PelatihanPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
