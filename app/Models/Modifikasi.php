<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifikasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemesanan_id',
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'jenis_pakaian',
        'ukuran',
        'warna',
        'modifikasi',
        'status',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
