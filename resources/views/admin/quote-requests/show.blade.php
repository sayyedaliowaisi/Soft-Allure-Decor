
@extends('layouts.admin')

@section('title', 'Quote Request Details')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-quote-requests.css') }}">
@endpush

@section('content')

<div class="aqr-page">

    <div class="aqr-header">
        <div>
            <span class="aqr-eyebrow">CUSTOMER QUOTATION</span>
            <h1>Quote Request #{{ $quoteRequest->id }}</h1>
            <p>Review project requirements and manage this enquiry.</p>
        </div>

        <a href="{{ route('admin.quote-requests.index') }}"
           class="aqr-back">
            ← All Requests
        </a>
    </div>

    @if(session('success'))
        <div class="aqr-alert" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="aqr-error" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="aqr-details-grid">

        {{-- REQUEST DETAILS --}}
        <section class="aqr-card">

            <div class="aqr-card-heading">
                <h2>Customer & Project Details</h2>

                <span class="aqr-status aqr-status-{{ $quoteRequest->status }}">
                    {{ ucfirst($quoteRequest->status) }}
                </span>
            </div>

            <div class="aqr-detail-fields">

                <div>
                    <span>Customer Name</span>
                    <strong>{{ $quoteRequest->name }}</strong>
                </div>

                <div>
                    <span>Email Address</span>
                    <a href="mailto:{{ $quoteRequest->email }}">
                        {{ $quoteRequest->email }}
                    </a>
                </div>

                <div>
                    <span>Phone Number</span>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $quoteRequest->phone) }}">
                        {{ $quoteRequest->phone }}
                    </a>
                </div>

                <div>
                    <span>City</span>
                    <strong>{{ $quoteRequest->city ?: 'Not specified' }}</strong>
                </div>

                <div>
                    <span>Product Category</span>
                    <strong>{{ $quoteRequest->category }}</strong>
                </div>

                <div>
                    <span>Quantity</span>
                    <strong>{{ $quoteRequest->quantity ?? 'Not specified' }}</strong>
                </div>

                <div>
                    <span>Estimated Budget</span>
                    <strong>{{ $quoteRequest->budget ?: 'Not specified' }}</strong>
                </div>

                <div>
                    <span>Project Timeline</span>
                    <strong>{{ $quoteRequest->timeline ?: 'Not specified' }}</strong>
                </div>

                <div>
                    <span>Received On</span>
                    <strong>
                        {{ $quoteRequest->created_at?->format('d M Y, h:i A') ?? '—' }}
                    </strong>
                </div>

            </div>

            <div class="aqr-message">
                <h3>Project Requirements</h3>
                <p>{{ $quoteRequest->message }}</p>
            </div>

            
{{-- ==========================================
     SELECTED PRODUCTS
========================================== --}}

@php
    $selectedProducts = is_array($quoteRequest->products)
        ? $quoteRequest->products
        : [];

    $totalProductQuantity = collect($selectedProducts)
        ->sum(function ($product) {
            return (int) ($product['quantity'] ?? 0);
        });
@endphp

@if(count($selectedProducts) > 0)

    <section class="aqr-products-section">

        <div class="aqr-products-heading">

            <div>
                <span class="aqr-products-eyebrow">
                    CUSTOMER PRODUCT SELECTION
                </span>

                <h3>Selected Products</h3>

                <p>
                    Products included in this quotation request.
                </p>
            </div>

            <span class="aqr-products-count">
                {{ count($selectedProducts) }}
                {{ count($selectedProducts) === 1 ? 'Product' : 'Products' }}
            </span>

        </div>

        <div class="aqr-products-table-wrap">

            <table class="aqr-products-table">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($selectedProducts as $index => $product)

                        @php
                            $productName = $product['name']
                                ?? 'Unknown Product';

                            $productId = $product['id']
                                ?? null;

                            $productSlug = $product['slug']
                                ?? null;

                            $productCategory = $product['category']
                                ?? 'Not specified';

                            $productQuantity = max(
                                0,
                                (int) ($product['quantity'] ?? 0)
                            );
                        @endphp

                        <tr>

                            <td class="aqr-product-index">
                                {{ $index + 1 }}
                            </td>

                            <td>
                                <div class="aqr-product-info">

                                    <strong>
                                        {{ $productName }}
                                    </strong>

                                    @if($productId)
                                        <span>
                                            Product ID: {{ $productId }}
                                        </span>
                                    @endif

                                </div>
                            </td>

                            <td>
                                <span class="aqr-product-category">
                                    {{ $productCategory }}
                                </span>
                            </td>

                            <td>
                                <span class="aqr-product-quantity">
                                    {{ $productQuantity }}
                                </span>
                            </td>

                            <td>
                                @if($productSlug)
                                    <a
                                        href="{{ route('products.show', $productSlug) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="aqr-product-view"
                                    >
                                        View Product ↗
                                    </a>
                                @else
                                    <span class="aqr-product-unavailable">
                                        Unavailable
                                    </span>
                                @endif
                            </td>

                        </tr>

                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="3">
                            Total Quantity
                        </td>

                        <td>
                            <strong>{{ $totalProductQuantity }}</strong>
                        </td>

                        <td></td>
                    </tr>
                </tfoot>

            </table>

        </div>

        <div class="aqr-products-note">
            Product names and quantities reflect the
            customer's selection when the request was submitted.
        </div>

    </section>

@endif


            @if($quoteRequest->attachment_path)
                <div class="aqr-attachment">
                    <div>
                        <h3>Customer Attachment</h3>
                        <p>{{ $quoteRequest->attachment_name ?: 'Attached file' }}</p>
                    </div>

                    <a href="{{ route('admin.quote-requests.download', $quoteRequest) }}"
                       class="aqr-btn aqr-btn-gold">
                        Download Attachment
                    </a>
                </div>
            @endif

        </section>

        {{-- ACTION PANEL --}}
        <aside class="aqr-card aqr-actions">

            <h2>Manage Request</h2>

            <p class="aqr-description">
                Update the status or contact the customer about their quotation.
            </p>

            <form method="POST"
                  action="{{ route('admin.quote-requests.status', $quoteRequest) }}">

                @csrf
                @method('PATCH')

                <label for="quote-request-status">Request Status</label>

                <select id="quote-request-status" name="status" required>
                    <option value="new" @selected($quoteRequest->status === 'new')>
                        New
                    </option>
                    <option value="read" @selected($quoteRequest->status === 'read')>
                        Read
                    </option>
                    <option value="replied" @selected($quoteRequest->status === 'replied')>
                        Replied
                    </option>
                </select>

                <button type="submit" class="aqr-btn aqr-btn-dark aqr-full">
                    Update Status
                </button>
            </form>

            <a
                href="mailto:{{ $quoteRequest->email }}?subject={{ rawurlencode('Re: Your Soft Allure Décor Quote Request') }}"
                class="aqr-btn aqr-btn-gold aqr-full"
            >
                Reply by Email
            </a>

            <p class="aqr-description">
                The reply button opens your email application.
                Mark the request as Replied after sending your response.
            </p>

            <form
                method="POST"
                action="{{ route('admin.quote-requests.destroy', $quoteRequest) }}"
                onsubmit="return confirm('Permanently delete this quote request and its attachment?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="aqr-btn aqr-btn-danger aqr-full">
                    Delete Request
                </button>
            </form>

        </aside>

    </div>

</div>

@endsection
