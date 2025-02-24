<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_attempt extends Model
{
    use HasFactory;
    protected $fillable = ['quiz_id', 'user_id', 'score', 'tanggal','completed_at'];

    protected $casts = [
        'tanggal' => 'datetime'
    ];
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}