<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $orders = Order::with('user', 'product')->latest()->paginate(10);

    return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    $users = User::all();
    $products = Produk::all();
    return view('orders.create', compact('users', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:produks,id',
        'quantity' => 'required|integer|min:1',
        'total_price' => 'required|numeric|min:0',
        'status' => 'required|string|in:pending,processing,completed,cancelled',
    ]);


    $order = Order::create($validatedData);

    return redirect()->route('orders.index')->with('success', 'Order successfully created!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {

        $order->load('user', 'product');

    return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $users = User::all();
        $products = Produk::all();
        return view('orders.edit', compact('order', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
    $validatedData = $request->validate([
        'user_id' => 'sometimes|required|exists:users,id',
        'product_id' => 'sometimes|required|exists:produks,id',
        'quantity' => 'sometimes|required|integer|min:1',
        'total_price' => 'sometimes|required|numeric|min:0',
        'status' => 'sometimes|required|string|in:pending,processing,completed,cancelled',
    ]);

    $order->update($validatedData);

    return redirect()->route('orders.show', $order)->with('success', 'Order successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Order successfully deleted!');
    }
}

