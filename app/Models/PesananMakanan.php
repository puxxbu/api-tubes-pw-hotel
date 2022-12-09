<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PesananMakanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan_makanans';

    protected $fillable = [
        'nama_pesanan', // Ayam,Es teh, pudding
        // 'jenis',
        'harga', // 30.000
        'jam_antar', // 18.00
        'user_id' // 1
    ];

    public function getCreatedAtAttribute()
    {
        if (!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdateAtAttribute()
    {
        if (!is_null($this->attributes['update_at'])) {
            return Carbon::parse($this->attributes['update_at'])->format('Y-m-d H:i:s');
        }
    }
}