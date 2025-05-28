<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananProduk extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_produks';

    protected $fillable = [
        'produk_id',
        'jenis_pakaian',
        'nama',
        'email',
        'nomor_telepon',
        'alamat',
        'jumlah',
        'total_harga',
        'status',
        'user_id',
    ];

    /**
     * Relasi ke Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}