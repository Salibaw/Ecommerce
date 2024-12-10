@extends('admin.layouts.app')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Brand List</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('brand.create') }}" class="btn btn-primary">Create Brand</a>
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
                <form method="GET" action="{{ route('brand.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="keyword" class="form-control" placeholder="Search by name or slug" value="{{ request('keyword') }}">
                        </div>
                        <div class="col-md-4 text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                            <a href="{{ route('brand.index') }}" class="btn btn-outline-secondary">Reset</a>
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
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $key => $brand)
                            <tr>
                                <td>{{ $loop->iteration + $brands->firstItem() - 1 }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    <span class="badge badge-{{ $brand->status ? 'success' : 'danger' }}">
                                        {{ $brand->status ? 'Active' : 'Blocked' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('brand.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('brand.destroy', $brand->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this brand?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No brands found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
