<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $primaryKey = 'testimoni_id'; 
    public $incrementing = true; // jika ya
    protected $keyType = 'int';  // atau 'string' jika UUID

    protected $fillable = [
        'user_id',
        'rate',
        'deskripsi',
        'gambar_testimoni',
        'pemesanan_jahitan_id',
        'pemesanan_produk_id',
        'modifikasi_jahitan_id',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke pemesanan jahitan
    public function pemesananJahitan()
    {
        return $this->belongsTo(PemesananJahitan::class, 'pemesanan_jahitan_id');
    }

    // Relasi ke pemesanan produk
    public function pemesananProduk()
    {
        return $this->belongsTo(PemesananProduk::class, 'pemesanan_produk_id');
    }

    // Relasi ke modifikasi jahitan
    public function modifikasiJahitan()
    {
        return $this->belongsTo(ModifikasiJahitan::class, 'modifikasi_jahitan_id');
    }
}
