<?php

// app/Models/UserPelatihan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPelatihan extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model ini
    protected $table = 'user_pelatihans';

    // Menambahkan user_id, pelatihan_id, dan status ke dalam fillable
    protected $fillable = [
        'user_id',
        'pelatihan_id',
    ];

    // Mendefinisikan relasi dengan model Pelatihan
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id'); // Menunjukkan relasi ke tabel pelatihans
    }

    // Mendefinisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Menunjukkan relasi ke tabel users
    }
}
