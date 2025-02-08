<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'name', 
        'email',
        'no_telp',
        'tgl_lahir'
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

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }


    public function pelatihans(): BelongsToMany
{
    return $this->belongsToMany(Pelatihan::class, 'pelatihan_teacher');
}
}