<?php

namespace App\Listeners;

use App\Models\Teacher;
use Illuminate\Auth\Events\Registered;

class CreateTeacherProfile
{
    public function handle(Registered $event): void
    {
        $user = $event->user;
        
        // Sesuaikan dengan implementasi role Anda
        if ($user->role === 'teacher') {
            // Buat record baru di table teachers
            Teacher::create([
                'user_id' => $user->id,
                'nip' => '', // Bisa diisi default atau kosong
                'name' => $user->name,
                'email' => $user->email,
                'no_telp' => '', // Bisa diisi default atau kosong
                'tgl_lahir' => now(), // Bisa diisi default date
            ]);
        }
    }
}