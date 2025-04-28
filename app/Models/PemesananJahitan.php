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
        'ukuran'
    ];
}
