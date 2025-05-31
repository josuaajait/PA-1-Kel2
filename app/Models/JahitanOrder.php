<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JahitanOrder extends Model
{
    protected $table = 'jahitan_orders';  // Pastikan nama tabel sesuai dengan yang ada di database

    protected $fillable = [
        'name', 'phone', 'address', 'jenis', 'bahan', 'warna', 'ukuran'];
}
