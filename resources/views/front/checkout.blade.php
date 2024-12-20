@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-checkout pt-4">
        <div class="container">
            <h2>Checkout</h2>
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <h4>Billing Details</h4>
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Your Order</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $grandTotal = 0; @endphp
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $item['name'] }} (x{{ $item['quantity'] }})</td>
                                        <td>Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                    </tr>
                                    @php    $grandTotal += $item['price'] * $item['quantity']; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>Rp{{ number_format($grandTotal, 2) }}</th>
                                </tr>
                            </tfoot>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>Rp{{ number_format($grandTotal, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="submit" class="btn btn-primary btn-block">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
@endsection