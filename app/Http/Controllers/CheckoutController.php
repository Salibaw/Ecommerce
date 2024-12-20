<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
{
    $categories = Category::where('status', 1)->with('subcategories')->get(); 
    $products = Product::with('images')->where('status', 1)->get();
    $cartItems = session()->get('cart', []); // Ambil data terbaru dari session

    if (empty($cartItems)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    return view('front.checkout', compact('cartItems','categories', 'products'));
}

    

public function process(Request $request)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'address' => 'required|string|max:500',
        'phone'   => 'required|string|max:20',
    ]);

    // Ambil data keranjang dari session
    $cartItems = session()->get('cart', []);

    if (empty($cartItems)) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    // Simpan order ke database
    $order = Order::create([
        'customer_name'  => $request->name,
        'customer_email' => $request->email,
        'customer_phone' => $request->phone,
        'customer_address' => $request->address,
        'grand_total'    => array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cartItems)),
        'status'         => 'Pending',
    ]);

    // Simpan detail item order ke tabel order_items
    foreach ($cartItems as $item) {
        $order->items()->create([
            'product_id' => $item['id'],
            'quantity'   => $item['quantity'],
            'price'      => $item['price'],
        ]);
    }

    // Hapus keranjang dari session setelah checkout selesai
    session()->forget('cart');

    return redirect()->route('orders.index')->with('success', 'Your order has been placed successfully!');
}


}
