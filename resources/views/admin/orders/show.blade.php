@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>
    <div class="card">
        <div class="card-body">
            <h5>Customer Details</h5>
            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
            <p><strong>Address:</strong> {{ $order->customer_address }}</p>

            <h5>Order Details</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp{{ number_format($item['price'], 2) }}</td>
                            <td>Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h5><strong>Grand Total:</strong> Rp{{ number_format($order->grand_total, 2) }}</h5>
        </div>
    </div>
</div>
@endsection
