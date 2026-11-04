{{-- PREMIUM INFORMATION BAR --}}
<div class="sa-topbar">
    <div class="sa-topbar-inner">
        <span class="sa-topbar-message">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7M5 9v11h14V9M9 20v-7h6v7"/></svg>
            Premium Home Décor &amp; Furnishings
        </span>
        <div class="sa-topbar-benefits">
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 13v-2a8 8 0 0 1 16 0v2M4 12h3v7H5a2 2 0 0 1-2-2v-3a2 2 0 0 1 1-2ZM20 12h-3v7h2a2 2 0 0 0 2-2v-3a2 2 0 0 0-1-2Z"/></svg>Free Consultation</span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3h12l4 7-10 11L2 10l4-7ZM2 10h20M9 3l-2 7 5 11 5-11-2-7"/></svg>Custom Solutions</span>
            <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 3h10l6 6v12H4zM14 3v6h6M7 13h10M7 17h7"/></svg>On-Time Delivery</span>
        </div>
    </div>
</div>

<header class="site-header sa-header" id="siteHeader">
    <div class="navbar-container sa-navbar-container">

        {{-- BRAND + HOME ICON --}}
        <div class="sa-brand-group">

            <a href="{{ route('home') }}"
               class="sa-home-icon"
               aria-label="Go to homepage"
               title="Home">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 64 64"
                     fill="none" stroke="currentColor" stroke-width="2.4"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 28 32 5l27 23M12 24v34h40V24M24 58V38h16v20M5 38 32 15l27 23"/>
                    <path d="M20 9V3M44 9V3"/>
                </svg>
            </a>

            <a href="{{ route('home') }}"
               class="navbar-logo sa-logo"
               aria-label="Soft Allure Décor Home">
                <span class="navbar-logo-main">Soft Allure</span>
                <span class="navbar-logo-sub">
                    <span></span>DÉCOR<span></span>
                </span>
            </a>

        </div>

        {{-- DESKTOP NAVIGATION --}}
        <nav class="desktop-nav sa-desktop-nav"
             aria-label="Main navigation">

            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Home
            </a>

            {{-- PRODUCTS DROPDOWN --}}
            <div class="sa-products-menu"
                 data-products-menu>

                <div class="sa-products-trigger">
                    <a href="{{ route('products') }}"
                       class="sa-products-link {{ request()->routeIs('products*') ? 'active' : '' }}">
                        Products
                    </a>

                    <button type="button"
                            class="sa-dropdown-toggle"
                            aria-label="Toggle product categories"
                            aria-expanded="false"
                            aria-controls="saDesktopProductsDropdown"
                            data-products-toggle>
                        <svg viewBox="0 0 24 24"
                             width="16" height="16"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             aria-hidden="true">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </button>
                </div>

                <div class="sa-dropdown"
                     id="saDesktopProductsDropdown"
                     data-products-dropdown>

                    <div class="sa-dropdown-heading">
                        <span>EXPLORE OUR COLLECTION</span>
                        <strong>Product Categories</strong>
                    </div>

                    <a href="{{ route('products') }}"
                       class="sa-dropdown-item sa-dropdown-all">
                        <span class="sa-dropdown-item-icon">✦</span>
                        <span>View All Products</span>
                        <span aria-hidden="true">↗</span>
                    </a>

                    @forelse($navbarCategories as $category)
                        <a href="{{ route('products.category', ['slug' => $category->slug]) }}"
                           class="sa-dropdown-item {{ request()->is('products/category/'.$category->slug) ? 'active' : '' }}">
                            <span class="sa-dropdown-item-icon">◇</span>
                            <span>{{ $category->name }}</span>
                            <span aria-hidden="true">↗</span>
                        </a>
                    @empty
                        <p class="sa-dropdown-empty">
                            Categories coming soon.
                        </p>
                    @endforelse

                </div>
            </div>

            <a href="{{ route('gallery') }}"
               class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
                Gallery
            </a>

            <a href="{{ route('about') }}"
               class="{{ request()->routeIs('about') ? 'active' : '' }}">
                About Us
            </a>

            <a href="{{ route('testimonials') }}"
               class="{{ request()->routeIs('testimonials') ? 'active' : '' }}">
                Testimonials
            </a>

            <a href="{{ route('contact') }}"
               class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                Contact
            </a>
        </nav>

        {{-- DESKTOP ACTIONS --}}
        <div class="navbar-actions sa-navbar-actions">

            {{-- SEARCH ICON --}}
            <button type="button"
                    class="sa-search-toggle"
                    id="saSearchToggle"
                    aria-label="Open product search"
                    aria-controls="saSearchPanel"
                    aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="21" height="21"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     aria-hidden="true">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>
            </button>

            {{-- GET A QUOTE --}}
            <a href="{{ route('get-a-quote') }}"
               class="navbar-quote-btn sa-quote-btn {{ request()->routeIs('get-a-quote') ? 'active' : '' }}"
               @if(request()->routeIs('get-a-quote')) aria-current="page" @endif>
                Get a Quote
                <span aria-hidden="true">↗</span>
            </a>

        </div>

        {{-- MOBILE ACTIONS --}}
        <div class="sa-mobile-actions">

            <button type="button"
                    class="sa-search-toggle sa-mobile-search"
                    id="saMobileSearchToggle"
                    aria-label="Open product search"
                    aria-controls="saSearchPanel"
                    aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="21" height="21"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     aria-hidden="true">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>
            </button>

            <button class="mobile-menu-toggle sa-mobile-toggle"
                    id="mobileMenuToggle"
                    type="button"
                    aria-label="Open navigation menu"
                    aria-controls="mobileNav"
                    aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>

    {{-- SEARCH PANEL --}}
    <div class="sa-search-panel"
         id="saSearchPanel"
         hidden>

        <div class="sa-search-panel-inner">
            <form action="{{ route('products') }}"
                  method="GET"
                  role="search"
                  class="sa-search-form">

                <svg viewBox="0 0 24 24"
                     width="20" height="20"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     aria-hidden="true">
                    <circle cx="11" cy="11" r="7"/>
                    <path d="m20 20-4-4"/>
                </svg>

                <input type="search"
                       name="search"
                       id="saSearchInput"
                       placeholder="Search products..."
                       aria-label="Search products"
                       value="{{ request('search', '') }}"
                       maxlength="100"
                       required>

                <button type="submit"
                        class="sa-search-submit">
                    Search
                </button>
            </form>

            <button type="button"
                    class="sa-search-close"
                    id="saSearchClose"
                    aria-label="Close search">
                &times;
            </button>
        </div>

    </div>
</header>

{{-- MOBILE OVERLAY --}}
<div class="mobile-menu-overlay"
     id="mobileMenuOverlay"></div>

{{-- MOBILE NAVIGATION --}}
<aside class="mobile-nav sa-mobile-nav"
       id="mobileNav"
       aria-label="Mobile navigation"
       aria-hidden="true">

    <div class="mobile-nav-header">
        <div class="mobile-nav-brand">
            Soft Allure
            <small>DÉCOR</small>
        </div>

        <button class="mobile-menu-close"
                id="mobileMenuClose"
                type="button"
                aria-label="Close navigation menu">
            &times;
        </button>
    </div>

    <nav class="mobile-nav-links sa-mobile-links"
         aria-label="Mobile links">

        <a href="{{ route('home') }}"
           class="{{ request()->routeIs('home') ? 'active' : '' }}">
            Home
        </a>

        {{-- MOBILE PRODUCTS ACCORDION --}}
        <div class="sa-mobile-products">

            <div class="sa-mobile-products-heading">
                <a href="{{ route('products') }}"
                   class="{{ request()->routeIs('products*') ? 'active' : '' }}">
                    Products
                </a>

                <button type="button"
                        class="sa-mobile-products-toggle"
                        id="saMobileProductsToggle"
                        aria-label="Show product categories"
                        aria-controls="saMobileProductsCategories"
                        aria-expanded="false">
                    <svg viewBox="0 0 24 24"
                         width="18" height="18"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2"
                         aria-hidden="true">
                        <path d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
            </div>

            <div class="sa-mobile-categories"
                 id="saMobileProductsCategories"
                 hidden>

                <a href="{{ route('products') }}">
                    View All Products
                </a>

                @foreach($navbarCategories as $category)
                    <a href="{{ route('products.category', ['slug' => $category->slug]) }}"
                       class="{{ request()->is('products/category/'.$category->slug) ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <a href="{{ route('gallery') }}"
           class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
            Gallery
        </a>

        <a href="{{ route('about') }}"
           class="{{ request()->routeIs('about') ? 'active' : '' }}">
            About Us
        </a>

        <a href="{{ route('testimonials') }}"
           class="{{ request()->routeIs('testimonials') ? 'active' : '' }}">
            Testimonials
        </a>

        <a href="{{ route('contact') }}"
           class="{{ request()->routeIs('contact') ? 'active' : '' }}">
            Contact
        </a>

    </nav>

    <div class="mobile-nav-bottom">

        <a href="tel:+919311036306">
            +91 9311036306
        </a>

        <a href="mailto:softallure.decor@gmail.com">
            softallure.decor@gmail.com
        </a>

        <a href="{{ route('get-a-quote') }}"
           class="mobile-quote-btn {{ request()->routeIs('get-a-quote') ? 'active' : '' }}"
           @if(request()->routeIs('get-a-quote')) aria-current="page" @endif>
            Get a Quote →
        </a>

    </div>
</aside>
