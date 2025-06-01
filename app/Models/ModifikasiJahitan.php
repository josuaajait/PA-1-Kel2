<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModifikasiJahitan extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti konvensi jamak snake_case dari nama model
    // protected $table = 'modifikasi_jahitans'; // Opsional jika nama tabel sudah benar

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'modifikasi_jahitan_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'user_id',
        'nama',
        'catatan',
        'jenis_pakaian',
        'pemesanan_produk_id',
        'pemesanan_jahitan_id',
    ];
}
