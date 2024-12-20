@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data" id="productForm">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" placeholder="slug"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="image">Product Image</label>
                                <input type="file" name="image[]" id="image" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="summernote form-control"
                                    placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Pricing</h4>
                            <div class="mb-3">
                                <label for="price">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Price"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="compare_price">Compare Price</label>
                                <input type="number" name="compare_price" id="compare_price" class="form-control"
                                    placeholder="Compare Price">
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Inventory</h4>
                            <div class="mb-3">
                                <label for="sku">SKU</label>
                                <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU" required>
                            </div>
                            <div class="mb-3">
                                <label for="barcode">Barcode</label>
                                <input type="text" name="barcode" id="barcode" class="form-control"
                                    placeholder="Barcode" pattern="\d*">
                            </div>
                            <div class="mb-3">
                                <label for="track_qty">Track Quantity</label>
                                <select name="track_qty" id="track_qty" class="form-control">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty" class="form-control" placeholder="Quantity"
                                    min="0">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Product Status</h4>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Category</h4>
                            <div class="mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option disabled>No categories available</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sub_category_id">Sub Category</label>
                                <select name="sub_category_id" id="sub_category_id" class="form-control">
                                    @forelse($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @empty
                                        <option disabled>No sub-categories available</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Brand</h4>
                            <select name="brand_id" id="brand_id" class="form-control">
                                @forelse($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @empty
                                    <option disabled>No brands available</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Featured</h4>
                            <select name="is_featured" id="is_featured" class="form-control">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</section>
<script>
    document.getElementById('title').addEventListener('input', function () {
        const slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = slug;
    });

</script>
@endsection