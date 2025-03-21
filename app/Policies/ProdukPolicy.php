<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProdukPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->role === 'admin' || $user->role === 'user'; // Allow both admins and users
    }

    public function view(User $user, Produk $produk)
    {
        return $user->role === 'admin' || $user->role === 'user'; // Allow viewing individual products
    }

    public function create(User $user) {
        return $user->role === 'admin';
    }
    
    public function update(User $user, Produk $produk) {
        return $user->role === 'admin';
    }
    
    public function delete(User $user, Produk $produk) {
        return $user->role === 'admin';
    }
    
}
