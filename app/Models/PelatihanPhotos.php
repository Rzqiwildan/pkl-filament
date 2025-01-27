<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelatihanPhotos extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'pelatihan_id'
    ];
    
    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class);
    }

}