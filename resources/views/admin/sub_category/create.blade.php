@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Sub Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('subcategories.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="{{ route('subcategories.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="1">Active</option>
                    <option value="0">Blocked</option>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('subcategories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
</form>

        <!-- /.card -->
    </section>
@endsection
