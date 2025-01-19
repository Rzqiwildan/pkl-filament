<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'name',
        'email',
        'nomor_telp',
        'jurusan',
        'fakultas',
        'universitas'
    ];
 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}