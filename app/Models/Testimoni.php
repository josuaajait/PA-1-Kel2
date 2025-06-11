<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    protected $primaryKey = 'testimoni_id'; 
    public $incrementing = true; // jika ya
    protected $keyType = 'int';  // atau 'string' jika UUID

    protected $fillable = [
        'user_id',
        'rate',
        'deskripsi',
        'gambar_testimoni',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
