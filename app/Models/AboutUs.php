<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
    protected $fillable = ['deskripsi', 'sejarah', 'visi', 'misi', 'is_active', 'user_id'];
}
