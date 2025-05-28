<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Ensure this matches your database table name

    protected $fillable = ['nama','jenis_pakaian', 'deskripsi', 'harga', 'gambar', 'stok', 'status', 'ukuran', 'warna', 'bahan', 'user_id'];
}

