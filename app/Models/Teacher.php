<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'name', 
        'email',
        'no_telp',
        'tgl_lahir'
    ];

    /**
     * Relasi ke tabel users (Setiap teacher memiliki satu user).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi many-to-many ke tabel pelatihans melalui tabel pivot pelatihan_teacher.
     */
    public function pelatihans(): BelongsToMany
    {
        return $this->belongsToMany(Pelatihan::class, 'pelatihan_teacher', 'teacher_id', 'pelatihan_id');
    }
}