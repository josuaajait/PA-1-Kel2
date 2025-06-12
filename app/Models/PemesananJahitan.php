<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananJahitan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_jahitans';

    // Tambahkan baris ini:
    protected $primaryKey = 'pemesanan_jahitan_id';

    public $incrementing = true;      // default true, tapi bisa eksplisit
    protected $keyType = 'int';       // karena primary key bertipe integer

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'jenis_pakaian',
        'bahan',
        'warna',
        'ukuran',
        'referensi_gambar',
        'bukti_pembayaran_uang_muka',
        'bukti_pembayaran_lunas', 
        'status',
        'user_id',
    ];

    public function ukuranPakaian()
    {
        return $this->hasOne(UkuranPakaian::class, 'pemesanan_jahitan_id', 'pemesanan_jahitan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
