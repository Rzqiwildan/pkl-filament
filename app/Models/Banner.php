<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_banner',
        'rincian_banner',
        'pelatihan_id',
        'order',
        'status',
    ];

    // Jika ada relasi ke model lain (misalnya pelatihan)
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }
}
