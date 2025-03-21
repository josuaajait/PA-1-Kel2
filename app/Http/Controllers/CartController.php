<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $produk = Produk::findOrFail($id);

        // Get cart session or create empty array
        $cart = Session::get('cart', []);

        // If product already exists in cart, increase quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $produk->name,
                "price" => $produk->price,
                "image" => $produk->image,
                "quantity" => 1
            ];
        }

        // Store in session
        Session::put('cart', $cart);

        // ✅ Redirect to cart page instead of reloading
        return redirect()->route('cart.view')->with('success', 'Product added to cart!');
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        return view('carts.view', compact('cart'));
    }

    public function removeFromCart($id)
{
    $cart = session()->get('cart', []);

    // Remove the item from the cart
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.view')->with('success', 'Item removed from cart.');
}

}
