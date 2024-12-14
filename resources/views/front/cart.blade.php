@extends('front.layouts.header')

@section('content')
<main>
    <section class="section-9 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/product/' . $item['image']) }}" 
                                                     class="img-thumbnail" width="80" height="80">
                                                <h5 class="ml-2">{{ $item['name'] }}</h5>
                                            </div>
                                        </td>
                                        <td>Rp{{ number_format($item['price'], 2) }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No items in cart.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
