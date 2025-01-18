@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @include('_message')
        <h1>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="mb-3">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by ID, Name, or Description..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary w-100">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('products.list', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-light text-decoration-none">
                        Name
                        @if (request('sort') === 'name')
                            <i class="bi bi-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Description</th>
                <th>
                    <a href="{{ route('products.list', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}" class="text-light text-decoration-none">
                        Price
                        @if (request('sort') === 'price')
                            <i class="bi bi-arrow-{{ request('direction') === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ \Illuminate\Support\Str::words($product->description, 20, '...') }}</td> <!-- Truncated Description -->
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('products.specific', $product) }}" class="btn btn-info btn-sm me-2">View</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                            <form method="POST" action="{{ route('products.delete', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
