<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryUser extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pelatihan_id', 'score'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }

    public function photos()
    {
        return $this->hasMany(PelatihanPhotos::class, 'pelatihan_id');
    }


}


