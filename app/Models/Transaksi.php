<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pelatihan_id',
        'status_pembayaran'
    ];

    protected $attributes = [
        'status_pembayaran' => 'pending'
    ];

    public static function getStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved'
        ];
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function pelatihan(): BelongsTo
    {
        return $this->belongsTo(Pelatihan::class);
    }
}