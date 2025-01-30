<?php

namespace App\Filament\Resources\JadwalPelatihanResource\Pages;

use App\Filament\Resources\JadwalPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalPelatihan extends EditRecord
{
    protected static string $resource = JadwalPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
