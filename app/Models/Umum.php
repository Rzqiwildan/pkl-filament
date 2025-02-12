<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Umum extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'email',
        'no_telp',
        'profile_photo_path',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
}