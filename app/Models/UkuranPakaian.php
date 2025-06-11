<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkuranPakaian extends Model
{
    use HasFactory;

    protected $table = 'ukuran_pakaian'; // <--- tambahkan ini
    protected $primaryKey = 'ukuran_id'; // <--- karena kamu pakai nama id custom

    protected $fillable = [
        'pemesanan_jahitan_id',
        'lingkar_dada',
        'lingkar_pinggang',
        'lingkar_pinggul',
        'panjang_baju',
        'panjang_lengan',
        'lebar_bahu',
        'lingkar_lengan',
        'lingkar_pergelangan',
        'tinggi_badan',
    ];

    public function pemesananJahitan()
    {
        return $this->belongsTo(PemesananJahitan::class, 'pemesanan_jahitan_id');
    }
}
