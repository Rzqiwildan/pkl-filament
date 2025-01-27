<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JadwalPelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'waktu',
        'hari',
        'lokasi',
        'pelatihan_id',
    ];

    protected $casts = [
        'waktu' => 'datetime',
        'hari' => 'date'
    ];

    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }
    
    public function pelatihans(): HasMany
    {
        return $this->hasMany(Pelatihan::class, 'jadwal_id');
    }

    public function getPelatihanName()
    {
        return $this->pelatihan ? $this->pelatihan->name : 'Tidak ada pelatihan';
    }
}