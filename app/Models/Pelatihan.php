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
        'teacher_id'
    ];
    
    public function setJenisAttribute($value)
    {
        $allowedValues = ['online', 'offline'];
        if (!in_array($value, $allowedValues)) {
            throw new \InvalidArgumentException("Jenis pelatihan harus 'online' atau 'offline'.");
        }
        $this->attributes['jenis'] = $value;
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

public function teachers()
{
    return $this->belongsToMany(Teacher::class);
}
    public function bagianPelatihans()
    {
        return $this->hasMany(BagianPelatihan::class, 'pelatihan_id');
    }
    
    public function materis()
    {
        return $this->hasMany(Materi::class, 'pelatihan_id');
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