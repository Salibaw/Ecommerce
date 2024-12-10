@extends('admin.layouts.app')

@push('styles')
    <style>
        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .img-thumbnail {
            border-radius: 8px;
            max-width: 70px;
            max-height: 70px;
            object-fit: cover;
        }

        .badge-active {
            background-color: #28a745;
            color: #fff;
        }

        .badge-inactive {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
@endpush

@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-primary">New Product</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <form action="{{ route('product.index') }}" method="GET">
                        <div class="input-group" style="width: 250px;">
                            <input type="text" name="search" class="form-control" placeholder="Search Products..."
                                value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th width="80">Image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>SKU</th>
                            <th width="100">Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                            <tr>
                                <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                <td>
                                    @if($product->images->isNotEmpty())
                                        <img src="{{ asset('uploads/product/' . optional($product->images->first())->path) }}"
                                            alt="{{ $product->title }}" class="img-thumbnail">
                                    @else
                                        <img src="{{ asset('images/placeholder.png') }}" alt="No Image" class="img-thumbnail">
                                    @endif
                                </td>
                                <td>{{ $product->title }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>
                                    <span class="badge {{ $product->status ? 'badge-active' : 'badge-inactive' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Are you sure want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
@endsection