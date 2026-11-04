
@extends('layouts.app')

@section('title', $category->name . ' | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/product-category.css') }}">
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
            'images/', 'uploads/', 'storage/'
        ])) {
            return asset($path);
        }

        return asset('storage/' . $path);
    };

    $categoryBanner = $category->image
        ? $imageUrl($category->image)
        : asset('images/categories-hero.jpg');
@endphp

<div class="sac-page">

    {{-- CATEGORY HERO --}}
    <section class="sac-hero">

        <div class="sac-container sac-hero-inner">

            <div class="sac-hero-copy">

                <div class="sac-eyebrow">
                    OUR CATEGORIES <span></span>
                </div>

                <h1>
                    Explore Our<br>
                    <em>Premium Categories</em>
                </h1>

                <p>
                    Discover an exclusive range of premium décor
                    collections crafted to bring elegance,
                    comfort and timeless beauty to your interiors.
                </p>

                <nav class="sac-breadcrumb" aria-label="Breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>›</span>
                    <a href="{{ route('products') }}">Products</a>
                    <span>›</span>
                    <span aria-current="page">{{ $category->name }}</span>
                </nav>

            </div>

        </div>

    </section>

    {{-- MAIN CATEGORY CONTENT --}}
    <section class="sac-main">

        <div class="sac-container sac-layout">

            {{-- SIDEBAR --}}
            <aside class="sac-sidebar">

                <div class="sac-sidebar-box">

                    <h2>
                        Shop By Category
                        <span>—</span>
                    </h2>

                    <nav aria-label="Product categories">

                        @foreach($categories as $item)

                            <a
                                href="{{ route('products.category', $item->slug) }}"
                                class="sac-side-link {{ $item->id === $category->id ? 'active' : '' }}"
                                @if($item->id === $category->id)
                                    aria-current="page"
                                @endif
                            >

                                <img
                                    src="{{ $imageUrl($item->image) }}"
                                    alt="{{ $item->name }}"
                                    loading="lazy"
                                >

                                <span class="sac-side-name">
                                    {{ $item->name }}
                                </span>

                                <span class="sac-side-arrow">›</span>

                            </a>

                        @endforeach

                    </nav>

                    <a href="{{ route('products') }}" class="sac-all-categories">
                        View All Products →
                    </a>

                </div>

                {{-- CONSULTATION CARD --}}
                <div class="sac-help-card">

                    <div class="sac-help-content">

                        <span class="sac-help-kicker">
                            EXPERT ASSISTANCE
                        </span>

                        <h3>Need Help Choosing?</h3>

                        <p>
                            Our décor experts are here to help you
                            discover the right solutions for your space.
                        </p>

                        <a href="{{ route('get-a-quote') }}">
                            Get Free Consultation →
                        </a>

                    </div>

                </div>

            </aside>

            {{-- RIGHT CONTENT --}}
            <div class="sac-content">

                {{-- CATEGORY FEATURE BANNER --}}
                <div
                    class="sac-feature"
                    style="--sac-feature-image: url('{{ $categoryBanner }}')"
                >

                    <div class="sac-feature-copy">

                        <div class="sac-eyebrow">
                            {{ strtoupper($category->name) }}
                            <span></span>
                        </div>

                        <h2>
                            Discover Premium<br>
                            {{ $category->name }}
                        </h2>

                        <p>
                            {{ $category->description ?: 'Explore our carefully curated collection of premium décor products designed to bring character, comfort and elegance to every space.' }}
                        </p>

                        <a href="#categoryProducts" class="sac-gold-btn">
                            Explore Collection
                            <span>→</span>
                        </a>

                    </div>

                </div>

                {{-- BENEFITS STRIP --}}
                <div class="sac-benefits">

                    <div class="sac-benefit">
                        <span class="sac-benefit-icon">◇</span>
                        <p>Premium Quality<br>Assured</p>
                    </div>

                    <div class="sac-benefit">
                        <span class="sac-benefit-icon">✧</span>
                        <p>Custom Designs<br>Available</p>
                    </div>

                    <div class="sac-benefit">
                        <span class="sac-benefit-icon">♧</span>
                        <p>Personalized Décor<br>Solutions</p>
                    </div>

                    <div class="sac-benefit">
                        <span class="sac-benefit-icon">☆</span>
                        <p>Expert Support<br>Always</p>
                    </div>

                </div>

                {{-- PRODUCTS HEADING --}}
                <div class="sac-collection-heading">

                    <div>
                        <span>EXPLORE THE COLLECTION</span>
                        <h2>{{ $category->name }}</h2>
                    </div>

                    <p>
                        Explore our carefully selected products
                        for your interior spaces.
                    </p>

                </div>

                {{-- SORTING TOOLBAR --}}
                <div id="categoryProducts" class="sac-toolbar">

                    <p class="sac-results-count">
                        @if($products->total() > 0)
                            Showing
                            <strong>{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong>
                            of
                            <strong>{{ $products->total() }}</strong>
                            Products
                        @else
                            No products available
                        @endif
                    </p>

                    <form
                        method="GET"
                        action="{{ route('products.category', $category->slug) }}"
                        class="sac-toolbar-controls"
                    >

                        <label for="sacSort">Sort by:</label>

                        <select name="sort" id="sacSort">
                            <option value="newest" @selected($sort === 'newest')>
                                Newest First
                            </option>

                            <option value="oldest" @selected($sort === 'oldest')>
                                Oldest First
                            </option>

                            <option value="price_low" @selected($sort === 'price_low')>
                                Price: Low to High
                            </option>

                            <option value="price_high" @selected($sort === 'price_high')>
                                Price: High to Low
                            </option>

                            <option value="name" @selected($sort === 'name')>
                                Name: A to Z
                            </option>
                        </select>

                        <label for="sacPerPage">Show:</label>

                        <select name="per_page" id="sacPerPage">
                            @foreach([8, 12, 16, 24] as $count)
                                <option
                                    value="{{ $count }}"
                                    @selected($perPage === $count)
                                >
                                    {{ $count }}
                                </option>
                            @endforeach
                        </select>

                        <noscript>
                            <button type="submit">Apply</button>
                        </noscript>

                    </form>

                </div>

                {{-- PRODUCT GRID --}}
                <div class="sac-product-grid">

                    @forelse($products as $product)

                        <article class="sac-product-card">

                            {{-- PRODUCT IMAGE --}}
                            <div class="sac-product-image-wrap">

                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    class="sac-product-image"
                                    aria-label="View {{ $product->name }} details"
                                >
                                    <img
                                        src="{{ $imageUrl($product->image) }}"
                                        alt="{{ $product->name }}"
                                        loading="lazy"
                                    >
                                </a>

                                @if($product->featured)
                                    <span class="sac-featured-badge">
                                        Featured
                                    </span>
                                @endif

                                <a
                                    href="{{ route('products.show', $product->slug) }}"
                                    class="sac-quick-view"
                                >
                                    View Details →
                                </a>

                            </div>

                            {{-- PRODUCT INFORMATION --}}
                            <div class="sac-product-body">

                                <span class="sac-product-category">
                                    {{ $category->name }}
                                </span>

                                <h3>
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>

                                <div class="sac-product-rating">
    <span aria-hidden="true">★</span>

    <strong>{{ $product->rating_value }}</strong>

    <span>
        ({{ $product->rating_count }}
        {{ $product->rating_count === 1 ? 'review' : 'reviews' }})
    </span>
</div>

                                @if($product->short_description)
                                    <p class="sac-product-description">
                                        {{ \Illuminate\Support\Str::limit($product->short_description, 75) }}
                                    </p>
                                @endif

                                <div class="sac-product-bottom">

                                    @if($product->price !== null)
    <p class="sac-price">
        ₹{{ number_format((float) $product->price, 2) }}
        <span class="sac-price-unit">
            / {{ $product->price_unit_label }}
        </span>
    </p>
@else
    <p class="sac-price sac-price-request">
        Price on Request
    </p>
@endif

                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        class="sac-view-link"
                                    >
                                        View Product →
                                    </a>

                                    <button
    type="button"
    class="sac-enquiry-btn sac-add-enquiry"
    data-product-id="{{ $product->id }}"
    data-product-name="{{ $product->name }}"
    data-product-slug="{{ $product->slug }}"
    aria-label="Add {{ $product->name }} to enquiry"
>
    <span aria-hidden="true">♧</span>
    Add to Enquiry
</button>

                                </div>

                            </div>

                        </article>

                    @empty

                        <div class="sac-empty">

                            <div class="sac-empty-icon">◇</div>

                            <h3>No Products Available Yet</h3>

                            <p>
                                Products for this category will appear here
                                once they are added from the admin panel.
                            </p>

                            <a href="{{ route('products') }}">
                                Browse All Products →
                            </a>

                        </div>

                    @endforelse

                </div>

                {{-- PAGINATION --}}
                @if($products->hasPages())

                    <div class="sac-pagination">
                        {{ $products->links() }}
                    </div>

                @endif

            </div>

        </div>

    </section>

    {{-- WHY CHOOSE SOFT ALLURE --}}
    <section class="sac-why">

        <div class="sac-container sac-why-inner">

            <div class="sac-why-copy">

                <span class="sac-why-kicker">
                    WHY CHOOSE US
                </span>

                <h2>
                    Why Choose<br>
                    Soft Allure Décor?
                </h2>

                <p>
                    Experience the perfect blend of luxury,
                    quality and thoughtful design with our
                    carefully curated décor collections.
                </p>

                <a href="{{ route('about') }}" class="sac-gold-btn">
                    Discover More →
                </a>

            </div>

            <div class="sac-why-features">

                <div>
                    <span>◇</span>
                    <p>Premium<br>Quality</p>
                </div>

                <div>
                    <span>✧</span>
                    <p>Elegant<br>Designs</p>
                </div>

                <div>
                    <span>♧</span>
                    <p>Expert<br>Support</p>
                </div>

                <div>
                    <span>☆</span>
                    <p>Custom<br>Solutions</p>
                </div>

            </div>

        </div>

    </section>

    {{-- FINAL CTA --}}
    <section class="sac-cta">

        <div class="sac-container sac-cta-inner">

            <div>
                <span>LET'S DESIGN SOMETHING BEAUTIFUL</span>

                <h2>Transform Your Space Today</h2>

                <p>
                    Get in touch with our team for personalized
                    décor recommendations and quotations.
                </p>
            </div>

            <a href="{{ route('contact') }}" class="sac-gold-btn">
                Contact Us →
            </a>

        </div>

    </section>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/product-category.js') }}" defer></script>
@endpush
