<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    // Jika primary key-nya bukan 'id'
    protected $primaryKey = 'produk_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'jenis_pakaian',
        'deskripsi',
        'harga',
        'gambar',
        'status',
        'ukuran',
        'warna',
        'bahan',
        'user_id'
    ];

    public function pemesananProduks()
{
    return $this->belongsToMany(
        PemesananProduk::class,      // Model tujuan
        'pemesanan_produk_produk',   // Tabel pivot
        'produk_id',                 // FK dari model ini (Produk)
        'pemesanan_produk_id'        // FK dari model relasi (PemesananProduk)
    )->withPivot('nama_produk', 'harga') // Jika tabel pivot punya kolom tambahan
     ->withTimestamps();                  // Jika tabel pivot punya timestamp
}

}
