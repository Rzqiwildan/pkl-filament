<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianPelatihan extends Model
{
    use HasFactory;
    protected $fillable = ['pelatihan_id', 'nama_bagian', 'is_quiz'];
    protected $attributes = [
        'is_quiz' => false, // Default false jika tidak diisi
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }

    public function materis()
{
    return $this->hasMany(Materi::class, 'bagian_pelatihan_id');
}
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}