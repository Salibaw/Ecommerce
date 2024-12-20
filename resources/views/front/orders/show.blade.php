@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-order-details pt-4">
        <div class="container">
            <h2>Order Details</h2>
            <div>
                <h4>Order ID: {{ $order->id }}</h4>
                <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Address:</strong> {{ $order->customer_address }}</p>
                <p><strong>Status:</strong> {{ $order->status }}</p>
            </div>

            <h4>Items:</h4>
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
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->title ?? 'Product not found' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp{{ number_format($item->price, 2) }}</td>
                            <td>Rp{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
