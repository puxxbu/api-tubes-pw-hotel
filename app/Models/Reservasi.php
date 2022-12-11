<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_kamar',
        'nama_pemesan',
        'tanggal_masuk',
        'tanggal_keluar',
        'status'
    ];

    protected $casts = [
        // 'tanggal_reservasi_verified_at' => 'datetime',
        // 'tanggal_keluar_verified_at' => 'datetime'
    ];
}
