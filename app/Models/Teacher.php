<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'role'
    ];

    public static function boot()
{
    parent::boot();

    static::saving(function ($teacher) {
        if (User::where('email', $teacher->email)->where('id', '!=', $teacher->user_id)->exists()) {
            throw new \Exception('Email sudah digunakan.');
        }
    });
}


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}