<?php

namespace App\Filament\Resources\UserPelatihanResource\Pages;

use App\Filament\Resources\UserPelatihanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserPelatihan extends EditRecord
{
    protected static string $resource = UserPelatihanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
