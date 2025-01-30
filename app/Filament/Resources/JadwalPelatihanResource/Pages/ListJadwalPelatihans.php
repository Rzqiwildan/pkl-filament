<?php

namespace App\Filament\Resources\JadwalPelatihanResource\Pages;

use App\Filament\Resources\JadwalPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPelatihans extends ListRecords
{
    protected static string $resource = JadwalPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
