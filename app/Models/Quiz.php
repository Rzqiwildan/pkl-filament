<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['bagian_pelatihan_id', 'title', 'description', 'duration'];

    public function getPelatihanAttribute()
    {
        return $this->bagianPelatihan->pelatihan;
    }

    public function bagianPelatihan()
    {
        return $this->belongsTo(BagianPelatihan::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Tambahkan relasi ke Quiz_attempt
    public function quiz_attempt()
    {
        return $this->hasMany(Quiz_attempt::class);
    }

    public function getRemainingTime()
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = $startTime->addMinutes($this->duration);
        $remainingTime = $endTime->diffInSeconds(now(), false);

        return $remainingTime > 0 ? $remainingTime : 0;
    }
}