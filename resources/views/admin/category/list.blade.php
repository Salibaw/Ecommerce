@extends('admin.layouts.app')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <div class="card-body">
                <!-- Search Bar -->
                <form method="GET" action="{{ route('categories.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="keyword" class="form-control" placeholder="Search by name or slug"
                                value="{{ request('keyword') }}">
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Show On Home</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration + $categories->firstItem() - 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if ($category->image)
                                        <img src="{{ asset('uploads/' . $category->image) }}" alt="Category Image" width="100"
                                            height="100">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $category->showHome ? 'success' : 'danger' }}">
                                        {{ $category->showHome ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $category->status ? 'success' : 'danger' }}">
                                        {{ $category->status ? 'Active' : 'Blocked' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Categories found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection