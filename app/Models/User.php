<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'user_id';
    protected $keyType = 'int';
    public $incrementing = true;


    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
        'no_hp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function pemesananProduks()
    {
        return $this->hasMany(PemesananProduk::class);
    }

    public function pemesananJahitans()
    {
        return $this->hasMany(PemesananJahitan::class, 'user_id', 'user_id');
    }

    public function modifikasiJahitans()
    {
        return $this->hasMany(ModifikasiJahitan::class, 'user_id', 'user_id');
    }

}