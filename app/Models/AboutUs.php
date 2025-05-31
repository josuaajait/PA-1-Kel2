<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;
     protected $table = 'about_us';
    protected $primaryKey = 'about_us_id';  // ini penting supaya Eloquent tahu primary key-nya
    protected $fillable = ['deskripsi', 'sejarah', 'visi', 'misi', 'is_active', 'user_id'];
}
