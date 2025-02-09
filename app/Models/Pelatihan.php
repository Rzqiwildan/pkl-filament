<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

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
    
    public function jadwalPelatihan(): HasOne
    {
        return $this->hasOne(JadwalPelatihan::class, 'pelatihan_id');
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

    public function getRemainingTimeAttribute()
    {
        if (!$this->jadwalPelatihan) {
            return "Tidak ada jadwal";
        }

        $endDate = Carbon::parse($this->jadwalPelatihan->end_date);
        $now = Carbon::now();

        $diffInDays = $endDate->diffInDays($now);
        $diffInHours = $endDate->diffInHours($now);

        return $diffInDays > 0 ? "$diffInDays hari tersisa" : "$diffInHours jam tersisa";
    }



}