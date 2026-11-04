
@extends('layouts.app')

@section('title', 'Premium Home Décor Products | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endpush

@section('content')

@php
    $imageUrl = function ($path) {
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

    $search = $search ?? '';
    $sort = $sort ?? 'newest';
    $category = $categorySlug ?? ($category ?? '');
@endphp

<div class="sa-products-page">

    {{-- HERO SECTION --}}
    <section class="sa-products-hero">

        <div class="sa-products-hero-overlay"></div>

        <div class="sa-products-container sa-products-hero-content">

            <div class="sa-products-kicker">
                OUR PRODUCTS <span></span>
            </div>

            <h1>
                Premium Décor<br>
                for Every Space
            </h1>

            <p>
                Discover our exclusive range of home décor solutions,
                crafted to add elegance, comfort and style to your interiors.
            </p>

            <div class="sa-products-breadcrumb">
                <a href="{{ route('home') }}">⌂ Home</a>
                <span>›</span>
                <span>Products</span>
            </div>

        </div>

    </section>

    {{-- PRODUCT CATEGORIES --}}
    <section class="sa-product-categories">

        <div class="sa-products-container">

            <div class="sa-section-heading">

                <div class="sa-section-eyebrow">
                    <span></span>
                    PRODUCT CATEGORIES
                    <span></span>
                </div>

                <h2>Explore Our Product Range</h2>

            </div>

            <div class="sa-category-grid">

                @forelse($categories->take(5) as $item)

                    <a
                        href="{{ route('products.category', $item->slug) }}"
                        class="sa-category-card"
                    >

                        <img
                            src="{{ $imageUrl($item->image) }}"
                            alt="{{ $item->name }}"
                            loading="lazy"
                        >

                        <div class="sa-category-overlay"></div>

                        <div class="sa-category-bottom">
                            <h3>{{ $item->name }}</h3>
                            <span class="sa-category-arrow">→</span>
                        </div>

                    </a>

                @empty

                    <div class="sa-category-empty">
                        Product categories will appear here once added
                        from the admin panel.
                    </div>

                @endforelse

            </div>

        </div>

    </section>

    {{-- PRODUCT LISTING --}}
    <section class="sa-product-listing" id="productCollection">

        <div class="sa-products-container">

            {{-- FILTER BAR --}}
            <div class="sa-product-toolbar">

                <div class="sa-category-filters">

                    <a
                        href="{{ route('products', array_filter([
                            'search' => $search,
                            'sort' => $sort !== 'newest' ? $sort : null,
                        ])) }}#productCollection"
                        class="sa-filter-link {{ $category === '' ? 'active' : '' }}"
                    >
                        All Products
                    </a>

                    @foreach($categories as $item)

                        <a
                            href="{{ route('products.category', $item->slug) }}"
                            class="sa-filter-link {{ $category === $item->slug ? 'active' : '' }}"
                        >
                            {{ $item->name }}
                        </a>

                    @endforeach

                </div>

                {{-- SORTING --}}
                <form
                    action="{{ route('products') }}#productCollection"
                    method="GET"
                    class="sa-sort-form"
                    id="saSortForm"
                >

                    @if($category !== '')
                        <input
                            type="hidden"
                            name="category"
                            value="{{ $category }}"
                        >
                    @endif

                    @if($search !== '')
                        <input
                            type="hidden"
                            name="search"
                            value="{{ $search }}"
                        >
                    @endif

                    <label for="saProductSort" class="sr-only">
                        Sort products
                    </label>

                    <select
                        id="saProductSort"
                        name="sort"
                        onchange="this.form.submit()"
                    >

                        <option
                            value="newest"
                            @selected($sort === 'newest')
                        >
                            Sort by: Newest First
                        </option>

                        <option
                            value="oldest"
                            @selected($sort === 'oldest')
                        >
                            Oldest First
                        </option>

                        <option
                            value="price_low"
                            @selected($sort === 'price_low')
                        >
                            Price: Low to High
                        </option>

                        <option
                            value="price_high"
                            @selected($sort === 'price_high')
                        >
                            Price: High to Low
                        </option>

                        <option
                            value="name"
                            @selected($sort === 'name')
                        >
                            Name: A to Z
                        </option>

                    </select>

                    <noscript>
                        <button type="submit">Apply Sort</button>
                    </noscript>

                </form>

            </div>

            {{-- SEARCH --}}
            <form
                action="{{ route('products') }}#productCollection"
                method="GET"
                class="sa-product-search"
            >

                @if($category !== '')
                    <input
                        type="hidden"
                        name="category"
                        value="{{ $category }}"
                    >
                @endif

                @if($sort !== 'newest')
                    <input
                        type="hidden"
                        name="sort"
                        value="{{ $sort }}"
                    >
                @endif

                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Search products..."
                    aria-label="Search products"
                >

                <button type="submit">
                    Search
                </button>

                @if($search !== '')

                    <a
                        href="{{ route('products', array_filter([
                            'category' => $category,
                            'sort' => $sort !== 'newest' ? $sort : null,
                        ])) }}#productCollection"
                    >
                        Clear
                    </a>

                @endif

            </form>

            {{-- PRODUCTS GRID --}}
            <div class="sa-products-grid">

                @forelse($products as $product)

                    <article class="sa-product-card">

                        {{-- PRODUCT IMAGE --}}
                        <div class="sa-product-image">

                            <a
                                href="{{ route('products.show', $product->slug) }}"
                                aria-label="View details of {{ $product->name }}"
                                style="display:block;width:100%;height:100%;"
                            >

                                <img
                                    src="{{ $imageUrl($product->image) }}"
                                    alt="{{ $product->name }}"
                                    loading="lazy"
                                >

                            </a>

                            @if($product->featured)

                                <span class="sa-featured-label">
                                    Featured
                                </span>

                            @endif

                        </div>

                        {{-- PRODUCT INFORMATION --}}
                        <div class="sa-product-info">

                            <p class="sa-product-category">
                                {{ $product->category?->name ?? 'Home Décor' }}
                            </p>

                            <h3>

                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    style="color:inherit;text-decoration:none;"
                                >
                                    {{ $product->name }}
                                </a>

                            </h3>

                            {{-- PRODUCT RATING --}}
                            <div
                                class="sa-product-rating"
                                aria-label="Rated {{ $product->rating_value }} out of 5 from {{ $product->rating_count }} reviews"
                            >

                                <span
                                    class="sa-rating-star"
                                    aria-hidden="true"
                                >
                                    ★
                                </span>

                                <strong class="sa-rating-value">
                                    {{ $product->rating_value }}
                                </strong>

                                <small class="sa-rating-count">
                                    ({{ $product->rating_count }}
                                    {{ $product->rating_count === 1 ? 'review' : 'reviews' }})
                                </small>

                            </div>

                            {{-- SHORT DESCRIPTION --}}
                            @if($product->short_description)

                                <p class="sa-product-description">
                                    {{ $product->short_description }}
                                </p>

                            @endif

                            {{-- PRODUCT PRICE --}}
                            <div
                                class="sa-product-price"
                                aria-label="Product price"
                            >

                                @if($product->price !== null)

                                    <span class="sa-price-label">
                                        Price
                                    </span>

                                    <strong class="sa-price-amount">
                                        ₹{{ number_format((float) $product->price, 2) }}
                                    </strong>

                                    <span class="sa-price-unit">
                                        / {{ $product->price_unit_label }}
                                    </span>

                                @else

                                    <strong class="sa-price-request">
                                        Price on Request
                                    </strong>

                                @endif

                            </div>

                            {{-- ADD TO ENQUIRY --}}
                            <button
                                type="button"
                                class="sa-enquiry-btn sa-add-enquiry"
                                data-product-id="{{ $product->id }}"
                                data-product-name="{{ $product->name }}"
                                data-product-slug="{{ $product->slug }}"
                                aria-label="Add {{ $product->name }} to enquiry"
                            >

                                <span aria-hidden="true">♧</span>
                                Add to Enquiry

                            </button>

                        </div>

                    </article>

                @empty

                    <div class="sa-products-empty">

                        <h3>No Products Found</h3>

                        <p>
                            No products match your selected filters.
                            Try another category or search term.
                        </p>

                        <a href="{{ route('products') }}">
                            View All Products
                        </a>

                    </div>

                @endforelse

            </div>

            {{-- PAGINATION --}}
            @if($products->hasPages())

                <div class="sa-products-pagination">
                    {{ $products->links() }}
                </div>

            @endif

        </div>

    </section>

    {{-- WHY CHOOSE US --}}
    <section class="sa-why-choose">

        <div class="sa-products-container sa-why-inner">

            <div class="sa-why-content">

                <span class="sa-why-kicker">
                    WHY CHOOSE US
                </span>

                <h2>
                    Your Trusted Home<br>
                    Décor Partner
                </h2>

                <p>
                    We bring elegance, quality and personalized solutions
                    to transform your spaces into something extraordinary.
                </p>

                <a
                    href="{{ route('about') }}"
                    class="sa-gold-button"
                >
                    Learn More
                    <span aria-hidden="true">→</span>
                </a>

            </div>

            <div class="sa-benefits-grid">

                <div class="sa-benefit">

                    <svg
                        viewBox="0 0 64 64"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M12 23L22 11H42L52 23L32 53L12 23Z"/>
                        <path d="M12 23H52"/>
                        <path d="M22 11L26 23L32 53L38 23L42 11"/>
                    </svg>

                    <h3>Premium<br>Quality</h3>

                </div>

                <div class="sa-benefit">

                    <svg
                        viewBox="0 0 64 64"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M14 45L43 16L49 22L20 51L11 54L14 45Z"/>
                        <path d="M39 20L45 26"/>
                        <path d="M10 20V12H18"/>
                        <path d="M46 52H54V44"/>
                        <path d="M24 12H30"/>
                        <path d="M34 52H40"/>
                        <path d="M10 30V36"/>
                    </svg>

                    <h3>Custom<br>Solutions</h3>

                </div>

                <div class="sa-benefit">

                    <svg
                        viewBox="0 0 64 64"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M7 30L19 20L29 26L35 23L45 20L57 30L46 42L35 34"/>
                        <path d="M19 20L29 14H38L45 20"/>
                        <path d="M7 30L14 38L19 34"/>
                        <path d="M57 30L50 38L46 34"/>
                        <path d="M19 34L32 46C34 48 37 48 39 45"/>
                        <path d="M25 40L30 45C32 47 35 47 37 45"/>
                        <path d="M35 34L44 42C46 44 48 42 48 40"/>
                    </svg>

                    <h3>Expert<br>Support</h3>

                </div>

                <div class="sa-benefit">

                    <svg
                        viewBox="0 0 64 64"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M32 7L50 14V30C50 42 43 50 32 56C21 50 14 42 14 30V14L32 7Z"/>
                        <path d="M23 31L29 37L42 24"/>
                    </svg>

                    <h3>On-Time<br>Delivery</h3>

                </div>

            </div>

        </div>

    </section>

    {{-- CONSULTATION BANNER --}}
    <section class="sa-products-consultation">

        <div class="sa-products-consultation-overlay"></div>

        <div class="sa-products-container sa-consultation-content">

            <h2>Let’s Create Your Dream Space</h2>

            <p>
                Get in touch with our experts for personalized
                décor solutions.
            </p>

            <a
                href="{{ route('get-a-quote') }}"
                class="sa-gold-button"
            >
                Get a Free Consultation →
            </a>

        </div>

    </section>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/products.js') }}" defer></script>
@endpush
