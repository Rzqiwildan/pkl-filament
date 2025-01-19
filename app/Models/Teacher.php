<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'name',
        'email',
        'no_telp',
        'tgl_lahir'
    ];
 
    protected $casts = [
        'tgl_lahir' => 'date'
    ];
 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }
}