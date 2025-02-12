<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class JadwalPelatihan extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_date',
        'end_date',
        'image',
        'pelatihan_id',
        'location_name',
        'jadwal',
    ];


    public function pelatihan()
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

    // Accessor untuk menghitung waktu tersisa
    public function getRemainingTimeAttribute()
    {
        if (!$this->end_date) {
            return "Tanggal tidak tersedia";
        }

        $endDate = Carbon::parse($this->end_date);
        $now = Carbon::now();

        $diffInDays = $endDate->diffInDays($now);
        $diffInHours = $endDate->diffInHours($now);

        return $diffInDays > 0 ? "$diffInDays hari tersisa" : "$diffInHours jam tersisa";
    }
}