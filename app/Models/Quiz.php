<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['bagian_pelatihan_id', 'title', 'description', 'duration'];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function bagianPelatihan()
    {
        return $this->belongsTo(BagianPelatihan::class, 'bagian_pelatihan_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getRemainingTime()
    {
        $startTime = Carbon::parse($this->start_time);
        $endTime = $startTime->addMinutes($this->duration);
        $remainingTime = $endTime->diffInSeconds(now(), false);

        return $remainingTime > 0 ? $remainingTime : 0;
    }
}