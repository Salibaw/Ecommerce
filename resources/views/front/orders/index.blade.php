@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-orders pt-4">
        <div class="container">
            <h2>Your Orders</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>Rp{{ number_format($order->grand_total, 2) }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
