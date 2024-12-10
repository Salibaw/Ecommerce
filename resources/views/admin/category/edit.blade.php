@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Edit Form -->
        <form action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data" method="post" id="categoryForm">
            @csrf
            @method('PUT') <!-- Method override for PUT request -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Enter category name" value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Slug Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                    placeholder="Enter category slug" value="{{ old('slug', $category->slug) }}">
                                @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image"> 
                                @if($category->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="100">
                                    </div>
                                @endif
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Show Home Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="showHome">Show on Home</label>
                                <select name="showHome" id="showHome" class="form-control">
                                    <option value="1" {{ old('showHome', $category->showHome) == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ old('showHome', $category->showHome) == 0 ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Blocked</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
 
</script>
@endsection
