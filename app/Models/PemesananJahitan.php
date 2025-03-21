<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JahitanOrder extends Model
{
    use HasFactory;

    protected $table = 'jahitan_orders';

    protected $fillable = [
        'name',
        'phone',
        'address',
        'jenis',
        'bahan',
        'warna',
        'modifikasi',
        'lingkar_leher',
        'lebar_bahu',
        'lingkar_dada',
        'lingkar_pinggang',
        'panjang_lengan',
        'panjang_kemeja',
        'lingkar_pinggul',
        'panjang_tangan',
        'lingkar_lengan_atas',
        'panjang_bada',
        'panjang_badan',
        'panjang_gaun'
    ];
}
