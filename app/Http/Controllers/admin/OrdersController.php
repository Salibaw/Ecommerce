<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        // Ambil semua order dari database
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Ambil detail order berdasarkan ID
        $order = Order::findOrFail($id);
        $orderItems = json_decode($order->items, true); // Decode JSON items

        return view('admin.orders.show', compact('order', 'orderItems'));
    }

public function updateStatus(Request $request, $id)
{
    // Validasi input status
    $request->validate([
        'status' => 'required|in:pending,process,delivered,complete,cancel',
    ]);

    // Temukan order berdasarkan ID
    $order = Order::findOrFail($id);

    // Update status
    $order->status = $request->status;
    $order->save();

    // Redirect dengan pesan sukses
    return redirect()->back()->with('success', 'Order status updated successfully.');
}
}
