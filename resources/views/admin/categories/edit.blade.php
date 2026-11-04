
@extends('layouts.admin')

@section('title', 'Edit Category')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-categories.css') }}">
@endpush

@section('content')

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

    $selectedStatus = old(
        'status',
        (int) $category->status
    );
@endphp

<div class="ac-page">

    {{-- PAGE HEADER --}}
    <div class="ac-header">

        <div>
            <span class="ac-eyebrow">
                CATEGORY MANAGEMENT
            </span>

            <h1>Edit Category</h1>

            <p>
                Update {{ $category->name }} and its details.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.index') }}"
            class="ac-btn ac-btn-outline"
        >
            ← Back to Categories
        </a>

    </div>

    {{-- VALIDATION ERRORS --}}
    @if($errors->any())
        <div class="ac-alert ac-alert-error" role="alert">

            <strong>
                Please correct the following:
            </strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    {{-- EDIT FORM --}}
    <form
        action="{{ route('admin.categories.update', $category) }}"
        method="POST"
        enctype="multipart/form-data"
        class="ac-form"
    >
        @csrf
        @method('PUT')

        <div class="ac-form-grid">

            {{-- MAIN COLUMN --}}
            <div class="ac-form-main">

                <div class="ac-panel ac-form-panel">

                    <h2>Category Information</h2>

                    {{-- NAME --}}
                    <div class="ac-field">

                        <label for="acName">
                            Category Name *
                        </label>

                        <input
                            type="text"
                            id="acName"
                            name="name"
                            value="{{ old('name', $category->name) }}"
                            maxlength="255"
                            required
                        >

                        @error('name')
                            <small class="ac-field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    {{-- SLUG --}}
                    <div class="ac-field">

                        <label for="acSlug">
                            Category Slug
                        </label>

                        <input
                            type="text"
                            id="acSlug"
                            name="slug"
                            value="{{ old('slug', $category->slug) }}"
                            maxlength="255"
                        >

                        <small>
                            Changing the slug will change this
                            category's public URL.
                        </small>

                        @error('slug')
                            <small class="ac-field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="ac-field">

                        <label for="acDescription">
                            Description
                        </label>

                        <textarea
                            id="acDescription"
                            name="description"
                            rows="6"
                            maxlength="5000"
                        >{{ old('description', $category->description) }}</textarea>

                        @error('description')
                            <small class="ac-field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

            </div>

            {{-- SIDE COLUMN --}}
            <div class="ac-form-side">

                {{-- CATEGORY IMAGE --}}
                <div class="ac-panel ac-form-panel">

                    <h2>Category Image</h2>

                    <div class="ac-image-preview">

                        <img
                            id="acImagePreview"
                            src="{{ $image }}"
                            alt="{{ $category->name }} image preview"
                        >

                    </div>

                    <div class="ac-field">

                        <label for="acImage">
                            Replace Image
                        </label>

                        <input
                            type="file"
                            id="acImage"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small>
                            Leave blank to keep the existing image.
                            Maximum 4 MB.
                        </small>

                        @error('image')
                            <small class="ac-field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

                {{-- VISIBILITY --}}
                <div class="ac-panel ac-form-panel">

                    <h2>Visibility</h2>

                    <div class="ac-field">

                        <label for="acStatus">
                            Category Status
                        </label>

                        <select
                            id="acStatus"
                            name="status"
                            required
                        >
                            <option
                                value="1"
                                @selected((string) $selectedStatus === '1')
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                @selected((string) $selectedStatus === '0')
                            >
                                Inactive
                            </option>
                        </select>

                        <small>
                            Inactive categories are hidden from
                            public product listings.
                        </small>

                        @error('status')
                            <small class="ac-field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>

            </div>

        </div>

        {{-- FORM ACTIONS --}}
        <div class="ac-form-footer">

            <a
                href="{{ route('admin.categories.index') }}"
                class="ac-btn ac-btn-outline"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="ac-btn ac-btn-primary"
            >
                Update Category
            </button>

        </div>

    </form>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/admin-categories.js') }}" defer></script>
@endpush
