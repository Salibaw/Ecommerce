@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $product->title) }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control summernote">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Pricing</h4>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="form-group">
                            <label for="compare_price">Compare at Price</label>
                            <input type="text" name="compare_price" id="compare_price" class="form-control" value="{{ old('compare_price', $product->compare_price) }}">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Inventory</h4>
                        <div class="form-group">
                            <label for="sku">SKU</label>
                            <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" id="barcode" class="form-control" value="{{ old('barcode', $product->barcode) }}">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="track_qty" id="track_qty" class="form-check-input" {{ $product->track_qty === 'Yes' ? 'checked' : '' }}>
                            <label for="track_qty" class="form-check-label">Track Quantity</label>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty', $product->qty) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Status</h4>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$product->status ? 'selected' : '' }}>Blocked</option>
                        </select>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Category</h4>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4>Brand</h4>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</section>
@endsection
