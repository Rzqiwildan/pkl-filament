<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';

    protected $fillable = [
        'pelatihan_id', 
        'name',
        'kode_materi',
        'file_path',
        'link',
        'bagian_pelatihan_id',
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }

    public function bagianPelatihan()
    {
        return $this->belongsTo(BagianPelatihan::class, 'bagian_pelatihan_id');
    }
    
    /**
     * Cek apakah materi ini berupa file atau link.
     */
    public function isFile()
    {
        return !is_null($this->file_path);
    }

    public function isLink()
    {
        return !is_null($this->link);
    }
}