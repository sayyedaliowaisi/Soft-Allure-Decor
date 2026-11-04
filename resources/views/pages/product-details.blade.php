
@extends('layouts.app')

@section('title', $product->name . ' | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/product-details.css') }}">
@endpush

@section('content')

@php
    $productImage = function ($path) {
        if (!$path) {
            return asset('images/product-placeholder.jpg');
        }

        if (\Illuminate\Support\Str::startsWith($path, [
            'http://', 'https://', '/'
        ])) {
            return $path;
        }

        if (\Illuminate\Support\Str::startsWith($path, [
            'storage/', 'images/', 'uploads/'
        ])) {
            return asset($path);
        }

        return asset('storage/' . $path);
    };

    $mainImage = $productImage($product->image);

    $galleryUrls = collect([$mainImage]);

    foreach ($product->images as $galleryImage) {
        $galleryUrls->push($productImage($galleryImage->image));
    }

    $galleryUrls = $galleryUrls->unique()->values();

    $categoryName = $product->category?->name ?? 'Premium Home Décor';

    $categoryUrl = $product->category
        ? route('products.category', $product->category->slug)
        : route('products');
@endphp

<div class="spd-page">

    {{-- BREADCRUMB --}}
    <div class="spd-container">
        <nav class="spd-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('products') }}">Products</a>
            <span>›</span>
            <a href="{{ $categoryUrl }}">{{ $categoryName }}</a>
            <span>›</span>
            <span class="spd-current">{{ $product->name }}</span>
        </nav>
    </div>

    {{-- MAIN PRODUCT --}}
    <section class="spd-product-section">
        <div class="spd-container spd-product-layout">

            
{{-- LEFT: PRODUCT GALLERY --}}
<div class="spd-gallery">

    <div class="spd-gallery-layout">

        {{-- LEFT VERTICAL THUMBNAILS --}}
        <div
            class="spd-thumbnail-list"
            aria-label="Product images"
        >
            @foreach($galleryUrls as $index => $url)
                <button
                    type="button"
                    class="spd-thumbnail {{ $index === 0 ? 'active' : '' }}"
                    data-image="{{ $url }}"
                    aria-label="View product image {{ $index + 1 }}"
                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}"
                >
                    <img
                        src="{{ $url }}"
                        alt="{{ $product->name }} thumbnail {{ $index + 1 }}"
                        loading="lazy"
                    >
                </button>
            @endforeach
        </div>

        {{-- RIGHT MAIN IMAGE --}}
        <div class="spd-gallery-main">

            <div class="spd-gallery-image-wrap">
                <img
                    src="{{ $mainImage }}"
                    alt="{{ $product->name }}"
                    id="spdMainImage"
                    loading="eager"
                    fetchpriority="high"
                >
            </div>

            @if($product->featured)
                <span class="spd-featured-badge">
                    Featured Collection
                </span>
            @endif

            <button
                type="button"
                class="spd-zoom-button"
                id="spdZoomButton"
                aria-label="View larger product image"
            >
                ⛶
            </button>

        </div>

    </div>

    <p class="spd-gallery-note">
        Images are for product reference. Contact us for
        available colours, finishes and customization options.
    </p>

</div>


            {{-- RIGHT: PRODUCT DETAILS --}}
            <div class="spd-details">

                <div class="spd-eyebrow">
                    <span class="spd-eyebrow-line"></span>
                    SOFT ALLURE DÉCOR COLLECTION
                </div>

                <a href="{{ $categoryUrl }}" class="spd-category">
                    {{ $categoryName }}
                </a>

                <h1>{{ $product->name }}</h1>

                <div class="spd-product-subtitle">
                    Premium Décor • Elegant Design • Custom Solutions
                </div>

                {{-- PRODUCT RATING --}}
                <a href="#productReviews" class="spd-product-rating">
                    <span aria-hidden="true">★</span>
                    <strong>{{ $product->rating_value }}</strong>
                    <small>
                        ({{ $product->rating_count }}
                        {{ $product->rating_count === 1 ? 'review' : 'reviews' }})
                    </small>
                </a>

                <div class="spd-divider"></div>

                <div class="spd-price-row">
                    <div>
                        <span class="spd-price-label">PRODUCT PRICE</span>

                        @if($product->price !== null)
                            <div class="spd-price">
                                ₹{{ number_format((float) $product->price, 2) }}

                                <span class="spd-price-unit">
                                    / {{ $product->price_unit_label }}
                                </span>
                            </div>
                        @else
                            <div class="spd-price spd-price-request">
                                Price on Request
                            </div>
                        @endif
                    </div>

                    <span class="spd-price-note">
                        Custom quotations available
                    </span>
                </div>

                @if($product->short_description)
                    <p class="spd-intro">
                        {{ $product->short_description }}
                    </p>
                @else
                    <p class="spd-intro">
                        Discover refined style and quality craftsmanship
                        with this premium Soft Allure Décor product.
                        Contact our team for personalized solutions.
                    </p>
                @endif

                {{-- PRODUCT FEATURES --}}
                <div class="spd-feature-points">
                    <div>
                        <span class="spd-feature-icon">◇</span>
                        <span>Premium Quality</span>
                    </div>

                    <div>
                        <span class="spd-feature-icon">✧</span>
                        <span>Elegant Finishes</span>
                    </div>

                    <div>
                        <span class="spd-feature-icon">✎</span>
                        <span>Customization Support</span>
                    </div>
                </div>

                {{-- QUANTITY + ENQUIRY --}}
                <div class="spd-purchase-panel">

                    <div class="spd-quantity-heading">
                        <label for="spdQuantity">Select Quantity</label>
                        <span>Specify your requirement</span>
                    </div>

                    <div class="spd-quantity-control">
                        <button
                            type="button"
                            id="spdDecrease"
                            aria-label="Decrease quantity"
                        >−</button>

                        <input
                            type="number"
                            id="spdQuantity"
                            value="1"
                            min="1"
                            max="100000"
                            inputmode="numeric"
                        >

                        <button
                            type="button"
                            id="spdIncrease"
                            aria-label="Increase quantity"
                        >+</button>
                    </div>

                    <div class="spd-action-buttons">

                        <button
                            type="button"
                            class="spd-primary-btn"
                            id="spdAddEnquiry"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-product-slug="{{ $product->slug }}"
                        >
                            <span>♧</span>
                            Add to Enquiry
                        </button>

                        <a
                            href="{{ route('get-a-quote', [
                                'product_id' => $product->id,
                                'product' => $product->name,
                            ]) }}"
                            class="spd-outline-btn"
                            id="spdQuoteNow"
                        >
                            Request Quote Now →
                        </a>

                    </div>

                    <p
                        class="spd-feedback"
                        id="spdFeedback"
                        role="status"
                        aria-live="polite"
                    ></p>

                    <a
                        href="{{ route('get-a-quote') }}"
                        class="spd-view-enquiry"
                    >
                        Continue to Enquiry Form →
                    </a>
                </div>

                {{-- ASSURANCE --}}
                <div class="spd-assurance">
                    <div>
                        <span>♢</span>
                        <p>Premium<br>Quality</p>
                    </div>

                    <div>
                        <span>✎</span>
                        <p>Custom<br>Solutions</p>
                    </div>

                    <div>
                        <span>♧</span>
                        <p>Expert<br>Support</p>
                    </div>

                    <div>
                        <span>✧</span>
                        <p>Timely<br>Service</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- PRODUCT INFORMATION --}}
    <section class="spd-information">
        <div class="spd-container">

            <div class="spd-section-heading">
                <span>DISCOVER THE DETAILS</span>
                <h2>Product Information</h2>
                <p>Explore the details of our carefully selected collection.</p>
            </div>

            <div class="spd-information-grid">

                <div class="spd-description-card">
                    <h3>Product Description</h3>

                    <div class="spd-description-text">
                        @if($product->description)
                            {!! nl2br(e($product->description)) !!}
                        @elseif($product->short_description)
                            {{ $product->short_description }}
                        @else
                            Contact our team to learn more about this product,
                            including available finishes and customization.
                        @endif
                    </div>
                </div>

                <div class="spd-specification-card">
                    <h3>Product Overview</h3>

                    <div class="spd-spec-row">
                        <span>Product</span>
                        <strong>{{ $product->name }}</strong>
                    </div>

                    <div class="spd-spec-row">
                        <span>Category</span>
                        <strong>{{ $categoryName }}</strong>
                    </div>

                    <div class="spd-spec-row">
                        <span>Product Code</span>
                        <strong>
                            SA-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}
                        </strong>
                    </div>

                    <div class="spd-spec-row">
                        <span>Price Unit</span>
                        <strong>{{ $product->price_unit_label }}</strong>
                    </div>

                    <div class="spd-spec-row">
                        <span>Availability</span>
                        <strong>Enquire for Availability</strong>
                    </div>

                    <div class="spd-spec-row">
                        <span>Customization</span>
                        <strong>Contact Our Team</strong>
                    </div>
                </div>

            </div>

        </div>
    </section>

    {{-- CUSTOMER REVIEWS --}}
    @include('pages.partials.product-reviews')

    {{-- RELATED PRODUCTS --}}
    @if($relatedProducts->isNotEmpty())
        <section class="spd-related">
            <div class="spd-container">

                <div class="spd-related-header">
                    <div class="spd-section-heading">
                        <span>EXPLORE OUR COLLECTION</span>
                        <h2>You May Also Like</h2>
                    </div>

                    <a href="{{ $categoryUrl }}" class="spd-related-all">
                        View Collection →
                    </a>
                </div>

                <div class="spd-related-grid">
                    @foreach($relatedProducts as $related)
                        <article class="spd-related-card">

                            <a
                                href="{{ route('products.show', $related->slug) }}"
                                class="spd-related-image"
                            >
                                <img
                                    src="{{ $productImage($related->image) }}"
                                    alt="{{ $related->name }}"
                                    loading="lazy"
                                >
                            </a>

                            <div class="spd-related-body">
                                <p>
                                    {{ $related->category?->name ?? $categoryName }}
                                </p>

                                <h3>
                                    <a href="{{ route('products.show', $related->slug) }}">
                                        {{ $related->name }}
                                    </a>
                                </h3>

                                <div class="spd-related-rating">
                                    <span aria-hidden="true">★</span>
                                    <strong>{{ $related->rating_value }}</strong>
                                    <small>
                                        ({{ $related->rating_count }}
                                        {{ $related->rating_count === 1 ? 'review' : 'reviews' }})
                                    </small>
                                </div>

                                <div class="spd-related-price">
                                    @if($related->price !== null)
                                        ₹{{ number_format((float) $related->price, 2) }}
                                        <small>
                                            / {{ $related->price_unit_label }}
                                        </small>
                                    @else
                                        Price on Request
                                    @endif
                                </div>

                                <a
                                    href="{{ route('products.show', $related->slug) }}"
                                    class="spd-related-button"
                                >
                                    View Details →
                                </a>
                            </div>

                        </article>
                    @endforeach
                </div>

            </div>
        </section>
    @endif

    {{-- CONSULTATION --}}
    <section class="spd-consultation">
        <div class="spd-container spd-consultation-inner">

            <div>
                <span>PERSONALIZED DÉCOR SOLUTIONS</span>

                <h2>Let's Create Your Dream Space</h2>

                <p>
                    Speak with our experts and discover the perfect
                    décor solutions for your home or business.
                </p>
            </div>

            <a href="{{ route('get-a-quote') }}">
                Get a Free Consultation →
            </a>

        </div>
    </section>

</div>

{{-- IMAGE LIGHTBOX --}}
<div
    class="spd-lightbox"
    id="spdLightbox"
    role="dialog"
    aria-modal="true"
    aria-label="Product image preview"
    aria-hidden="true"
    hidden
>
    <button
        type="button"
        id="spdLightboxClose"
        class="spd-lightbox-close"
        aria-label="Close image preview"
    >×</button>

    <img
        id="spdLightboxImage"
        src="{{ $mainImage }}"
        alt="{{ $product->name }}"
    >
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/product-details.js') }}" defer></script>
@endpush
