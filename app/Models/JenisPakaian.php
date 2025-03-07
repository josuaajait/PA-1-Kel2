<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class JenisPakaian extends Model
{
    use HasFactory;

    protected $table = 'jenis_pakaian';

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'harga',
        'stok',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function getGambarAttribute($value)
    {
        return url('storage/' . $value);
    }

    public function getHargaAttribute($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }

    public function getStokAttribute($value)
    {
        return $value . ' pcs';
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d F Y H:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d F Y H:i', strtotime($value));
    }

    public function getDeskripsiAttribute($value)
    {
        return ucfirst($value);
    }

    public function getNamaAttribute($value)
    {
        return ucfirst($value);
    }
}
