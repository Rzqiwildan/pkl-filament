<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditTeacher extends EditRecord
{
    protected static string $resource = TeacherResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
         // Jika password diisi, hash password
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Jika password kosong, hapus dari data agar tidak mengupdate password
            unset($data['password']);
        }

        // Pastikan role tetap teacher
        $data['role'] = 'teacher';

        return $data;
    }
}