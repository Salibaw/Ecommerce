@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $product->title }}" placeholder="Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $product->slug }}" placeholder="Slug" required>
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Pricing</h4>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" placeholder="Price" required>
                            </div>
                            <div class="mb-3">
                                <label for="compare_price">Compare Price</label>
                                <input type="number" name="compare_price" id="compare_price" class="form-control" value="{{ $product->compare_price }}" placeholder="Compare Price">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Inventory</h4>
                            <div class="mb-3">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control" value="{{ $product->sku }}" placeholder="SKU" required>
                            </div>
                            <div class="mb-3">
                                <label for="barcode">Barcode</label>
                                <input type="text" name="barcode" id="barcode" class="form-control" value="{{ $product->barcode }}" placeholder="Barcode">
                            </div>
                            <div class="mb-3">
                                <label for="track_qty">Track Quantity</label>
                                <select name="track_qty" id="track_qty" class="form-control">
                                    <option value="No" {{ $product->track_qty === 'No' ? 'selected' : '' }}>No</option>
                                    <option value="Yes" {{ $product->track_qty === 'Yes' ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="{{ $product->qty }}" placeholder="Quantity" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Images</h4>
                            <div class="row">
                                @foreach ($product->images as $image)
                                    <div class="col-md-4 text-center mb-3">
                                        <img src="{{ asset('uploads/product_images/' . $image->image) }}" class="img-thumbnail" alt="Product Image">
                                        <button type="button" class="btn btn-danger btn-sm mt-2 delete-image" data-image-id="{{ $image->id }}">Delete</button>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="images">Add New Images</label>
                                <input type="file" name="images[]" id="images" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Product Status</h4>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Category</h4>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Sub Category</h4>
                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}" {{ $product->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Brand</h4>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Featured</h4>
                            <select name="is_featured" id="is_featured" class="form-control">
                                <option value="No" {{ $product->is_featured === 'No' ? 'selected' : '' }}>No</option>
                                <option value="Yes" {{ $product->is_featured === 'Yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</section>

<script>
    document.getElementById('title').addEventListener('input', function () {
        const slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });

    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function () {
            const imageId = this.getAttribute('data-image-id');
            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`/admin/product_images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                }).then(response => {
                    if (response.ok) {
                        this.closest('.text-center').remove();
                    } else {
                        alert('Failed to delete image.');
                    }
                });
            }
        });
    });
</script>
@endsection
