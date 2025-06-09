<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananProduk extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_produks';

    // Tambahkan baris ini jika ID-nya bukan "id"
    protected $primaryKey = 'pemesanan_produk_id';

    public $incrementing = true;
    protected $keyType = 'int';

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

    public function produks()
    {
        return $this->belongsToMany(
            Produk::class,
            'pemesanan_produk_produk',
            'pemesanan_produk_id',
            'produk_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
