<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Auth\Events\Registered;

class CreateTeacher extends CreateRecord
{
    protected static string $resource = TeacherResource::class;

    protected function afterCreate(): void
    {
        // Trigger Registered event setelah user dibuat
        event(new Registered($this->record));
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set role sebagai teacher
        $data['role'] = 'teacher';
        
        // Password sudah di-hash di form schema, tidak perlu di-hash lagi
        return $data;
    }

    // Redirect setelah berhasil membuat data
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}