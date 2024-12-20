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
                                @php $grandTotal = 0; @endphp
                                @forelse ($cartItems as $item)
                                    <tr data-id="{{ $item['id'] }}">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('uploads/product/' . $item['image']) }}"
                                                    class="img-thumbnail" width="80" height="80">
                                                <h5 class="ml-2">{{ $item['name'] }}</h5>
                                            </div>
                                        </td>
                                        <td class="price">Rp{{ number_format($item['price'], 2) }}</td>
                                        <td>
                                            <div class="input-group quantity-control" style="width: 110px;">
                                                <button class="btn btn-outline-secondary btn-decrease"
                                                    type="button">-</button>
                                                <input type="number" class="form-control text-center quantity-input"
                                                    value="{{ $item['quantity'] }}" min="1"
                                                    max="{{ $item['stock'] ?? 100 }}">
                                                <button class="btn btn-outline-secondary btn-increase"
                                                    type="button">+</button>
                                            </div>
                                        </td>
                                        <td class="total">Rp{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
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
                                    @php    $grandTotal += $item['price'] * $item['quantity']; @endphp
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No items in cart.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Grand Total:</strong></td>
                                    <td colspan="2" id="grand-total">Rp{{ number_format($grandTotal) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cartTable = document.getElementById('cart');

        // Event untuk mengubah quantity
        cartTable.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-decrease') || e.target.classList.contains('btn-increase')) {
                const row = e.target.closest('tr');
                const quantityInput = row.querySelector('.quantity-input');
                const price = parseFloat(row.querySelector('.price').innerText.replace(/[^0-9.-]+/g, ""));
                const totalCell = row.querySelector('.total');

                let quantity = parseInt(quantityInput.value);

                // Tambah/kurangi quantity
                if (e.target.classList.contains('btn-decrease') && quantity > 1) {
                    quantity--;
                } else if (e.target.classList.contains('btn-increase')) {
                    quantity++;
                }

                // Update jumlah quantity input
                quantityInput.value = quantity;
                const newTotal = price * quantity;
                totalCell.innerText = `Rp${newTotal.toLocaleString('id-ID', { minimumFractionDigits: 2 })}`;

                updateGrandTotal();
                updateQuantity(row.dataset.id, quantity);
            }
        });
        // Fungsi untuk memperbarui Grand Total
        function updateGrandTotal() {
            let grandTotal = 0;

            document.querySelectorAll('#cart .total').forEach(function (totalCell) {
                let totalValue = totalCell.innerText.replace(/[^0-9.,-]/g, ''); // Hapus semua kecuali angka, koma, titik
                totalValue = totalValue.replace(',', ''); // Hapus koma untuk format internasional
                grandTotal += parseFloat(totalValue) || 0; // Parse angka, default ke 0 jika NaN
            });

            // Pastikan format ke Rupiah dengan dua desimal
            document.getElementById('grand-total').innerText = `Rp${grandTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
        }
        // Kirim request ke server untuk memperbarui quantity
        function updateQuantity(id, quantity) {
            fetch(`/cart/update/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: quantity })
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Cart updated:', data);
                })
                .catch(error => {
                    console.error('Error updating cart:', error);
                });
        }
    });
</script>

<!-- Tambahkan CSS untuk menyembunyikan spinner pada input number -->
<style>
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Untuk Firefox */
    }
</style>
@endsection