<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jadwal_Pelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'waktu',
        'hari',
        'lokasi'
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'hari' => 'date'
    ];
    
    public function pelatihans(): HasMany
    {
        return $this->hasMany(Pelatihan::class, 'jadwal_id');
    }
}