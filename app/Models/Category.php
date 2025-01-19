<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'kode_materi',
        'materials'
    ];
    
    public function pelatihans(): HasMany
    {
        return $this->hasMany(Pelatihan::class);
    }
}