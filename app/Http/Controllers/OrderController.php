<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        $products = Product::with('images')->where('status', 1)->get();
        $orders = Order::with('items.product')->latest()->get();
        return view('front.orders.index', compact('orders','categories','products'));
    }

    public function show($id)
    {
        $categories = Category::where('status', 1)->with('subcategories')->get(); 
        $products = Product::with('images')->where('status', 1)->get();
        $order = Order::with('items.product')->findOrFail($id);
        return view('front.orders.show', compact('order','categories','products'));
    }
}
