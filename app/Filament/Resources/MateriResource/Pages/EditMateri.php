<?php

namespace App\Filament\Resources\MateriResource\Pages;

use App\Filament\Resources\MateriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMateri extends EditRecord
{
    protected static string $resource = MateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
