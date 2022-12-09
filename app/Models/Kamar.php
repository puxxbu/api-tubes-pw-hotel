<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kamar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'harga',
        'jenis_kamar',
        'jumlah_tersedia',
    ];

    // public function getCreatedAtAttribute()
    // {
    //     if (!is_null($this->attributes['created_at'])) {
    //         return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
    //     }
    // }

    // public function getUpdateAtAttribute()
    // {
    //     if (!is_null($this->attributes['update_at'])) {
    //         return Carbon::parse($this->attributes['update_at'])->format('Y-m-d H:i:s');
    //     }
    // }
}