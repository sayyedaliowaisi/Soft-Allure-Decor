
@extends('layouts.admin')

@section('title', 'Manage Categories')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-categories.css') }}">
@endpush

@section('content')

<div class="ac-page">

    {{-- PAGE HEADER --}}
    <div class="ac-header">

        <div>
            <span class="ac-eyebrow">
                PRODUCT MANAGEMENT
            </span>

            <h1>Categories</h1>

            <p>
                Organize and manage your décor collections.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.create') }}"
            class="ac-btn ac-btn-primary"
        >
            + Add Category
        </a>

    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="ac-alert ac-alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @if(session('error'))
        <div class="ac-alert ac-alert-error" role="alert">
            {{ session('error') }}
        </div>
    @endif

    {{-- CATEGORY STATISTICS --}}
    <div class="ac-stats">

        <div class="ac-stat">
            <span>Total Categories</span>
            <strong>{{ $totalCategories }}</strong>
        </div>

        <div class="ac-stat">
            <span>Active Categories</span>
            <strong>{{ $activeCategories }}</strong>
        </div>

        <div class="ac-stat">
            <span>Inactive Categories</span>
            <strong>{{ $inactiveCategories }}</strong>
        </div>

    </div>

    {{-- CATEGORY TABLE --}}
    <div class="ac-panel">

        <div class="ac-panel-heading">

            <div>
                <h2>All Categories</h2>
                <p>
                    View, edit and manage category information.
                </p>
            </div>

            <input
                type="search"
                id="acCategorySearch"
                class="ac-search"
                placeholder="Search on this page..."
                aria-label="Search categories on this page"
            >

        </div>

        <div class="ac-table-wrap">

            <table class="ac-table">

                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Slug</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $category)

                        @php
                            $image = $category->image;

                            if (!$image) {
                                $image = asset('images/product-placeholder.jpg');
                            } elseif (\Illuminate\Support\Str::startsWith($image, [
                                'http://',
                                'https://',
                                '/'
                            ])) {
                                // Keep absolute URL unchanged.
                            } elseif (\Illuminate\Support\Str::startsWith($image, [
                                'storage/',
                                'images/',
                                'uploads/'
                            ])) {
                                $image = asset($image);
                            } else {
                                $image = asset('storage/' . $image);
                            }
                        @endphp

                        <tr class="ac-category-row">

                            {{-- CATEGORY --}}
                            <td>

                                <div class="ac-category-info">

                                    <img
                                        src="{{ $image }}"
                                        alt="{{ $category->name }}"
                                        loading="lazy"
                                    >

                                    <div>
                                        <strong>
                                            {{ $category->name }}
                                        </strong>

                                        <small>
                                            {{ \Illuminate\Support\Str::limit(
                                                $category->description ?: 'No description',
                                                65
                                            ) }}
                                        </small>
                                    </div>

                                </div>

                            </td>

                            {{-- SLUG --}}
                            <td>
                                <code>{{ $category->slug }}</code>
                            </td>

                            {{-- PRODUCT COUNT --}}
                            <td>
                                {{ $category->products_count }}
                            </td>

                            {{-- STATUS --}}
                            <td>

                                @if($category->status)

                                    <span class="ac-status ac-status-active">
                                        Active
                                    </span>

                                @else

                                    <span class="ac-status ac-status-inactive">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            {{-- ACTIONS --}}
                            <td>

                                <div class="ac-actions">

                                    <a
                                        href="{{ route('admin.categories.edit', $category) }}"
                                        class="ac-action-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="ac-delete-form"
                                        data-category-name="{{ $category->name }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="ac-action-delete"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5">

                                <div class="ac-empty">

                                    <h3>No Categories Yet</h3>

                                    <p>
                                        Create your first product category
                                        to get started.
                                    </p>

                                    <a
                                        href="{{ route('admin.categories.create') }}"
                                        class="ac-btn ac-btn-primary"
                                    >
                                        Create Category
                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        @if($categories->hasPages())
            <div class="ac-pagination">
                {{ $categories->links() }}
            </div>
        @endif

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/admin-categories.js') }}" defer></script>
@endpush
