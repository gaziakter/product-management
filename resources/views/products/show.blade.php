@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="row g-0">
            <!-- Product Image -->
            <div class="col-md-4">
                <img src="{{ asset('assets/products/' . $product->image) }}" class="img-fluid rounded-start" alt="{{ $product->name }}">
            </div>
            <!-- Product Details -->
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="card-title">{{ $product->name }}</h1>
                    <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
                    <p class="card-text">
                        <strong>Stock:</strong> 
                        @if($product->stock > 0)
                            {{ $product->stock }} units available
                        @else
                            <span class="text-danger">Out of stock</span>
                        @endif
                    </p>
                    <p class="card-text">
                        <small class="text-muted">Last updated: {{ $product->updated_at->format('F d, Y H:i A') }}</small>
                    </p>

                    <!-- Action Buttons -->
                    <div class="d-flex mt-3">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-2">Edit</a>
                        <form method="POST" action="{{ route('products.delete', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary ms-auto">Back to Products</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
