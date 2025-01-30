<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'kesulitan',
        'jenis',
        'deskripsi',
        'thumbnail',
        'harga',
        'kapasitas',
        'category_id',
        'materi_id',
        'jadwal_id',
        'user_id',
        'email'
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function materi(): BelongsTo
    {
        return $this->belongsTo(Materi::class);
    }
    
    public function jadwalPelatihan(): BelongsTo
    {
        return $this->belongsTo(JadwalPelatihan::class, 'jadwal_id');
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function photos(): HasMany
    {
        return $this->hasMany(PelatihanPhotos::class);
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    // Mendefinisikan relasi dengan model User melalui tabel pivot 'user_pelatihans'
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_pelatihans'); // Pelatihan memiliki banyak pengguna melalui tabel pivot
    }

    public function decreaseCapacity()
    {
        if ($this->kapasitas > 0) {
            $this->decrement('kapasitas');
        }
    }


}