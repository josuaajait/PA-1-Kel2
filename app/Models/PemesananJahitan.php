<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananJahitan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_jahitans';

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'jenis_pakaian',
        'bahan',
        'warna',
        'ukuran',
        'referensi_gambar',
        'status',
        'user_id',
    ];
}
