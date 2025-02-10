<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Mendefinisikan relasi dengan model Pelatihan melalui tabel pivot 'user_pelatihans'
    public function pelatihans()
    {
        return $this->belongsToMany(Pelatihan::class, 'user_pelatihans'); // User dapat mengikuti banyak pelatihan
    }

    // Model User.php
    public function hasRegistered($pelatihanId)
    {
        return $this->pelatihans()->where('pelatihan_id', $pelatihanId)->exists();
    }

    public function teacher()
{
    return $this->hasOne(Teacher::class, 'user_id');
}
public function umum()
{
    return $this->hasOne(Umum::class, 'user_id', 'id');
}


}