
@extends('layouts.admin')

@section('title', 'Manage Products')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
@endpush

@section('content')
<div class="ap-page">

    <div class="ap-page-header">
        <div>
            <span class="ap-eyebrow">PRODUCT MANAGEMENT</span>
            <h1>All Products</h1>
            <p>Manage your décor products, pricing and visibility.</p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="ap-btn ap-btn-primary">
            + Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="ap-alert ap-alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="ap-alert ap-alert-error" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="ap-stats">
        <div class="ap-stat">
            <span>Total Products</span>
            <strong>{{ \App\Models\Product::count() }}</strong>
        </div>

        <div class="ap-stat">
            <span>Active Products</span>
            <strong>{{ \App\Models\Product::where('status', true)->count() }}</strong>
        </div>

        <div class="ap-stat">
            <span>Featured Products</span>
            <strong>{{ \App\Models\Product::where('featured', true)->count() }}</strong>
        </div>
    </div>

    <div class="ap-panel">

        <div class="ap-panel-header">
            <div>
                <h2>Product Inventory</h2>
                <p>Search and manage all products.</p>
            </div>

            <form method="GET"
                  action="{{ route('admin.products.index') }}"
                  class="ap-search-form">

                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search products..."
                    aria-label="Search products"
                >

                <button type="submit" class="ap-btn ap-btn-dark">
                    Search
                </button>

                @if($search !== '')
                    <a href="{{ route('admin.products.index') }}"
                       class="ap-btn ap-btn-outline">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        <div class="ap-table-wrap">
            <table class="ap-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                        @php
                            $image = $product->image;

                            if (!$image) {
                                $image = asset('images/product-placeholder.jpg');
                            } elseif (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '/'])) {
                                // Absolute URL
                            } elseif (\Illuminate\Support\Str::startsWith($image, ['storage/', 'images/', 'uploads/'])) {
                                $image = asset($image);
                            } else {
                                $image = asset('storage/' . $image);
                            }
                        @endphp

                        <tr>
                            <td>
                                <div class="ap-product-cell">
                                    <img
                                        src="{{ $image }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                    >

                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <small>{{ $product->slug }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                {{ $product->category?->name ?? 'Uncategorized' }}
                            </td>

                            <td>
                                @if($product->price !== null)
                                    ₹{{ number_format((float) $product->price, 2) }}
                                @else
                                    <span class="ap-muted">On Request</span>
                                @endif
                            </td>

                            <td>
                                @if($product->featured)
                                    <span class="ap-badge ap-badge-featured">
                                        Featured
                                    </span>
                                @else
                                    <span class="ap-muted">No</span>
                                @endif
                            </td>

                            <td>
                                @if($product->status)
                                    <span class="ap-badge ap-badge-active">
                                        Active
                                    </span>
                                @else
                                    <span class="ap-badge ap-badge-inactive">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="ap-actions">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="ap-action-edit">
                                        Edit
                                    </a>

                                    @if($product->status && $product->category?->status)
                                        <a href="{{ route('products.show', $product->slug) }}"
                                           class="ap-action-view"
                                           target="_blank"
                                           rel="noopener noreferrer">
                                            View
                                        </a>
                                    @endif

                                    <form
                                        action="{{ route('admin.products.destroy', $product) }}"
                                        method="POST"
                                        class="ap-delete-form"
                                        data-product-name="{{ $product->name }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="ap-action-delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="ap-empty">
                                    <h3>No Products Found</h3>
                                    <p>
                                        @if($search !== '')
                                            No products match your search.
                                        @else
                                            Add your first product to get started.
                                        @endif
                                    </p>

                                    <a href="{{ route('admin.products.create') }}"
                                       class="ap-btn ap-btn-primary">
                                        Add Product
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="ap-pagination">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/admin-products.js') }}" defer></script>
@endpush
