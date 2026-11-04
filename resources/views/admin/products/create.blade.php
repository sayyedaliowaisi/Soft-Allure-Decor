
@extends('layouts.admin')

@section('title', 'Add Product')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-products.css') }}">
@endpush

@section('content')
<div class="ap-page">

    <div class="ap-page-header">
        <div>
            <span class="ap-eyebrow">PRODUCT MANAGEMENT</span>
            <h1>Add New Product</h1>
            <p>Add a new product to your décor collection.</p>
        </div>

        <a href="{{ route('admin.products.index') }}"
           class="ap-btn ap-btn-outline">
            ← Back to Products
        </a>
    </div>

    @if($errors->any())
        <div class="ap-alert ap-alert-error" role="alert">
            <strong>Please correct the following:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('admin.products._form')

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/admin-products.js') }}" defer></script>
@endpush
