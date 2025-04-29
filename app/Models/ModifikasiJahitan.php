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
    protected $fillable = [
        'nama',
        'catatan',
        'jenis_pakaian',
    ];
}
