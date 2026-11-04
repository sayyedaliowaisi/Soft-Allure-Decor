@extends('layouts.app')

@section('title', 'Soft Allure Décor | Premium Home Décor & Furnishings')

@section('content')

{{-- ==========================================
     HERO SECTION
========================================== --}}

<section class="home-hero" id="homeHero" aria-label="Featured décor collections">

    {{-- Background Slides --}}
    <div class="hero-slides">

        <div class="hero-slide active">
            <img
                src="{{ asset('images/hero.jpg') }}"
                alt="Luxury living room interior"
                fetchpriority="high"
            >
        </div>

        <div class="hero-slide">
            <img
                src="{{ asset('images/hero-2.jpg') }}"
                alt="Elegant home furnishings"
                loading="lazy"
            >
        </div>

        <div class="hero-slide">
            <img
                src="{{ asset('images/hero-3.jpg') }}"
                alt="Premium custom interior décor"
                loading="lazy"
            >
        </div>

    </div>

    <div class="hero-gradient"></div>

    {{-- Content --}}
    <div class="hero-container">

        <div class="hero-content">

            <div class="hero-content-slide active">

                <span class="hero-eyebrow">
                    PREMIUM HOME DÉCOR & FURNISHINGS
                </span>

                <h1>
                    Transforming Spaces
                    <br>
                    Into <em>Beautiful</em>
                    <br>
                    Stories
                </h1>

                <p>
                    Discover exquisite décor solutions for residential,
                    commercial and hospitality spaces. From elegant
                    curtains to bespoke furniture, we bring your vision
                    to life.
                </p>

                <a href="{{ route('products') }}" class="hero-primary-btn">
                    Explore Our Collection
                    <span aria-hidden="true">↗</span>
                </a>

            </div>

            <div class="hero-content-slide">

                <span class="hero-eyebrow">
                    ELEGANT INTERIOR SOLUTIONS
                </span>

                <h2>
                    Thoughtful Design
                    <br>
                    For <em>Beautiful</em>
                    <br>
                    Living
                </h2>

                <p>
                    Explore refined textures, carefully selected
                    furnishings and timeless interior details.
                </p>

                <a href="{{ route('products') }}" class="hero-primary-btn">
                    Discover Our Products
                    <span aria-hidden="true">↗</span>
                </a>

            </div>

            <div class="hero-content-slide">

                <span class="hero-eyebrow">
                    CUSTOM DÉCOR & FURNISHINGS
                </span>

                <h2>
                    Every Detail
                    <br>
                    Made <em>Uniquely</em>
                    <br>
                    Yours
                </h2>

                <p>
                    Bring your vision to life with furnishing and
                    décor solutions tailored to your space.
                </p>

                <a href="{{ route('contact') }}" class="hero-primary-btn">
                    Start Your Project
                    <span aria-hidden="true">↗</span>
                </a>

            </div>

        </div>

    </div>

    {{-- Slider Controls --}}
    <div class="hero-controls">

        <div class="hero-slide-counter">
            <span id="heroCurrentSlide">01</span>
            <span class="hero-counter-line"></span>
            <span>03</span>
        </div>

        <div class="hero-arrows">

            <button type="button" id="heroPrev" aria-label="Previous slide">
                ←
            </button>

            <button type="button" id="heroNext" aria-label="Next slide">
                →
            </button>

        </div>

    </div>

    {{-- Scroll Indicator --}}
    <a href="#homeFeatures" class="hero-scroll-indicator">
        <span>SCROLL TO EXPLORE</span>
        <span class="hero-scroll-line"></span>
    </a>

</section>


{{-- ==========================================
     FEATURES STRIP
========================================== --}}

<section class="home-features" id="homeFeatures">

    <div class="home-features-container">

        <div class="home-feature-item">
            <div class="home-feature-icon">◇</div>
            <div>
                <h3>Premium Quality</h3>
                <p>Only the finest materials</p>
            </div>
        </div>

        <div class="home-feature-item">
            <div class="home-feature-icon">✧</div>
            <div>
                <h3>Custom Solutions</h3>
                <p>Tailored to your style</p>
            </div>
        </div>

        <div class="home-feature-item">
            <div class="home-feature-icon">◷</div>
            <div>
                <h3>Timely Delivery</h3>
                <p>On schedule, always</p>
            </div>
        </div>

        <div class="home-feature-item">
            <div class="home-feature-icon">✦</div>
            <div>
                <h3>Expert Support</h3>
                <p>From selection to installation</p>
            </div>
        </div>

    </div>

</section>



{{-- ==========================================
     PREMIUM COLLECTIONS - DYNAMIC CATEGORIES
========================================== --}}

<section class="sa-products-section" id="collections">

    <div class="sa-products-container">

        {{-- Heading Row --}}
        <div class="sa-products-heading-row">

            <div class="sa-products-heading">

                <span class="sa-products-label">
                    OUR PRODUCTS
                </span>

                <h2>
                    Explore Our Premium Collections
                </h2>

            </div>

            <a
                href="{{ route('products') }}"
                class="sa-products-view-all"
            >
                View All Products
                <span aria-hidden="true">→</span>
            </a>

        </div>

        {{-- Dynamic Category Cards --}}
        <div class="sa-products-grid">

            @forelse($homeCategories as $category)

                @php
                    $categoryImage = $category->image;

                    if (!$categoryImage) {
                        $categoryImage = asset('images/product-placeholder.jpg');
                    } elseif (
                        \Illuminate\Support\Str::startsWith(
                            $categoryImage,
                            ['http://', 'https://', '/']
                        )
                    ) {
                        // Use existing absolute URL.
                    } elseif (
                        \Illuminate\Support\Str::startsWith(
                            $categoryImage,
                            ['storage/', 'images/', 'uploads/']
                        )
                    ) {
                        $categoryImage = asset($categoryImage);
                    } else {
                        $categoryImage = asset('storage/' . $categoryImage);
                    }
                @endphp

                <a
                    href="{{ route('products.category', $category->slug) }}"
                    class="sa-product-card"
                    aria-label="Explore {{ $category->name }}"
                >

                    <img
                        src="{{ $categoryImage }}"
                        alt="{{ $category->name }}"
                        loading="lazy"
                    >

                    <div class="sa-product-overlay"></div>

                    <div class="sa-product-content">

                        <div class="sa-product-text">

                            <h3>{{ $category->name }}</h3>

                            <p>
                                {{ \Illuminate\Support\Str::limit(
                                    $category->description
                                        ?: 'Explore our premium décor collection.',
                                    65
                                ) }}
                            </p>

                        </div>

                        <span
                            class="sa-product-arrow"
                            aria-hidden="true"
                        >
                            →
                        </span>

                    </div>

                </a>

            @empty

                <div class="sa-collections-empty">

                    <h3>Our Collections Are Coming Soon</h3>

                    <p>
                        We're preparing beautiful décor collections
                        for your space.
                    </p>

                    <a href="{{ route('contact') }}">
                        Contact Us
                    </a>

                </div>

            @endforelse

        </div>

    </div>

</section>



{{-- =====================================================
     ABOUT SOFT ALLURE DÉCOR + WHY CHOOSE US
===================================================== --}}

<section class="sa-about-strip" id="about">

    <div class="sa-about-strip-container">

        {{-- LEFT IMAGE --}}
        <div class="sa-about-strip-image">

            <img
                src="{{ asset('images/about.jpg') }}"
                alt="Elegant home décor arrangement with flowers and decorative accessories"
                loading="lazy"
            >

        </div>

        {{-- CENTER ABOUT CONTENT --}}
        <div class="sa-about-strip-content">

            <span class="sa-about-strip-eyebrow">
                ABOUT SOFT ALLURE DÉCOR
            </span>

            <h2>
                Crafting Elegant<br>
                Interiors Since Day One
            </h2>

            <p>
                At Soft Allure Décor, we believe that every space has
                a story. Our curated collection of premium home décor
                and furnishings is designed to bring comfort, style and
                <strong>sophistication to your interiors.</strong>
                With a focus on quality,
                <strong>customization</strong> and timeless design,
                we work closely with our clients to create spaces
                that inspire.
            </p>

            <a href="{{ route('about') }}" class="sa-about-strip-btn">
                Learn More
                <span aria-hidden="true">→</span>
            </a>

        </div>

        {{-- RIGHT WHY CHOOSE US --}}
        <div class="sa-about-strip-why">

            <h3>Why Choose Us?</h3>

            <div class="sa-about-strip-features">

                {{-- Feature 1 --}}
                <div class="sa-about-strip-feature">

                    <div class="sa-about-strip-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.6"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <rect x="4" y="5" width="16" height="15" rx="2"/>
                            <path d="M8 5V3h8v2M8 20v-5l4-3 4 3v5"/>
                            <path d="M8 9h2M14 9h2"/>
                        </svg>
                    </div>

                    <div>
                        <h4>Wide Range of Premium Products</h4>
                        <p>Curated for modern living</p>
                    </div>

                </div>

                {{-- Feature 2 --}}
                <div class="sa-about-strip-feature">

                    <div class="sa-about-strip-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.6"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M4 19l5-1 10-10-4-4L5 14l-1 5Z"/>
                            <path d="m13 6 4 4M3 21h18"/>
                            <path d="M8 5l2-2 3 3"/>
                        </svg>
                    </div>

                    <div>
                        <h4>Customized Solutions</h4>
                        <p>For unique spaces and projects</p>
                    </div>

                </div>

                {{-- Feature 3 --}}
                <div class="sa-about-strip-feature">

                    <div class="sa-about-strip-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.6"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M3 21V9l6-4 6 4v12"/>
                            <path d="M15 21V4l6 3v14"/>
                            <path d="M7 21v-6h4v6M18 9v2M18 14v2"/>
                            <path d="M2 21h20"/>
                        </svg>
                    </div>

                    <div>
                        <h4>Residential &amp; Commercial</h4>
                        <p>Homes, offices, hotels &amp; more</p>
                    </div>

                </div>

                {{-- Feature 4 --}}
                <div class="sa-about-strip-feature">

                    <div class="sa-about-strip-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.6"
                             stroke-linecap="round" stroke-linejoin="round"
                             aria-hidden="true">
                            <path d="M12 2l2.8 2.1 3.5.2.9 3.4 2.3 2.7-1.5 3.2.2 3.5-3.2 1.5L12 22l-3-2.4-3.2-1.5.2-3.5-1.5-3.2 2.3-2.7.9-3.4 3.5-.2L12 2Z"/>
                            <path d="m8.5 12 2.4 2.4 4.8-5"/>
                        </svg>
                    </div>

                    <div>
                        <h4>Trusted by Designers &amp; Architects</h4>
                        <p>Collaborating for better spaces</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     OUR PROJECTS SECTION
===================================================== --}}

<section class="sa-projects" id="projects">

    <div class="sa-projects-container">

        {{-- Section Header --}}
        <div class="sa-projects-header">

            <div class="sa-projects-heading">

                <span class="sa-projects-eyebrow">
                    OUR PROJECTS
                </span>

                <h2>
                    Inspiring Spaces, Beautifully Designed
                </h2>

            </div>

            <a href="{{ route('gallery') }}"
               class="sa-projects-view-all">
                View All Projects
                <span aria-hidden="true">→</span>
            </a>

        </div>

        {{-- Projects Grid --}}
        <div class="sa-projects-grid">

            {{-- Residential --}}
            <div class="sa-project-item">

                <div class="sa-project-image">
                    <img
                        src="{{ asset('images/projects/residential.jpg') }}"
                        alt="Elegant residential living room interior"
                        loading="lazy"
                    >
                </div>

                <div class="sa-project-info">
                    <h3>Residential</h3>
                    <p>Elegant homes, personalized</p>
                </div>

            </div>

            {{-- Commercial --}}
            <div class="sa-project-item">

                <div class="sa-project-image">
                    <img
                        src="{{ asset('images/projects/commercial.jpg') }}"
                        alt="Modern commercial workspace interior"
                        loading="lazy"
                    >
                </div>

                <div class="sa-project-info">
                    <h3>Commercial</h3>
                    <p>Modern workspaces, better ideas</p>
                </div>

            </div>

            {{-- Hospitality --}}
            <div class="sa-project-item">

                <div class="sa-project-image">
                    <img
                        src="{{ asset('images/projects/hospitality.jpg') }}"
                        alt="Luxury hospitality bedroom interior"
                        loading="lazy"
                    >
                </div>

                <div class="sa-project-info">
                    <h3>Hospitality</h3>
                    <p>Memorable stays, stylish spaces</p>
                </div>

            </div>

            {{-- Custom Projects --}}
            <div class="sa-project-item">

                <div class="sa-project-image">
                    <img
                        src="{{ asset('images/projects/custom-projects.jpg') }}"
                        alt="Customized elegant interior décor project"
                        loading="lazy"
                    >
                </div>

                <div class="sa-project-info">
                    <h3>Custom Projects</h3>
                    <p>Tailored to your vision</p>
                </div>

            </div>

        </div>

    </div>

</section>



{{-- =====================================================
     TRUSTED BY LEADING BRANDS & CLIENTS
===================================================== --}}

<section class="sa-trusted-brands" aria-labelledby="sa-trusted-title">

    <div class="sa-trusted-container">

        <h2 id="sa-trusted-title" class="sa-trusted-heading">
            TRUSTED BY LEADING BRANDS &amp; CLIENTS
        </h2>

        <div class="sa-trusted-logos">

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/tata.png') }}"
                    alt="Tata"
                    loading="lazy"
                >
            </div>

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/itc.png') }}"
                    alt="ITC Limited"
                    loading="lazy"
                >
            </div>

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/radisson.png') }}"
                    alt="Radisson"
                    loading="lazy"
                >
            </div>

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/leela.png') }}"
                    alt="The Leela"
                    loading="lazy"
                >
            </div>

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/dlf.png') }}"
                    alt="DLF"
                    loading="lazy"
                >
            </div>

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/hcl.png') }}"
                    alt="HCL"
                    loading="lazy"
                >
            </div>

            <div class="sa-trusted-logo">
                <img
                    src="{{ asset('images/brands/accor.png') }}"
                    alt="Accor"
                    loading="lazy"
                >
            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     TESTIMONIAL BANNER
     REAL SPACES, REAL STORIES
===================================================== --}}

<section
    class="sa-testimonial-banner"
    id="testimonials"
    aria-labelledby="sa-testimonial-title"
>

    {{-- Background Image --}}
    <div class="sa-testimonial-background" aria-hidden="true">
        <img
            src="{{ asset('images/testimonials/testimonial-banner.jpg') }}"
            alt=""
            loading="lazy"
        >
    </div>

    {{-- Dark Gradient Overlay --}}
    <div class="sa-testimonial-overlay" aria-hidden="true"></div>

    {{-- Center Content --}}
    <div class="sa-testimonial-container">

        <div class="sa-testimonial-content">

            <span class="sa-testimonial-eyebrow">
                WHAT OUR CLIENTS SAY
            </span>

            <h2 id="sa-testimonial-title">
                Real Spaces, Real Stories.
            </h2>

            <p>
                Hear from our clients who turned their vision
                into beautiful spaces with Soft Allure Décor.
            </p>

            <a
                href="{{ route('home') }}#testimonials-content"
                class="sa-testimonial-btn"
            >
                Read Testimonials
                <span aria-hidden="true">→</span>
            </a>

        </div>

    </div>

</section>



{{-- =====================================================
     CONTACT CTA STRIP
     LET'S CREATE SOMETHING BEAUTIFUL
===================================================== --}}

<section class="sa-contact-strip" id="contact-cta">

    {{-- Decorative Leaves --}}
    <div class="sa-contact-leaves" aria-hidden="true">
        <img
            src="{{ asset('images/contact/leaves.png') }}"
            alt=""
            loading="lazy"
        >
    </div>

    <div class="sa-contact-strip-container">

        {{-- Heading --}}
        <div class="sa-contact-intro">

            <h2>
                Let's Create Something Beautiful
            </h2>

            <p>
                Get in touch with our team for expert advice,
                custom solutions or a personalized quote.
            </p>

        </div>

        {{-- Contact Details --}}
        <div class="sa-contact-details">

            {{-- Phone --}}
            <a
                href="tel:+919311036306"
                class="sa-contact-detail"
            >

                <span class="sa-contact-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <path d="M22 16.9v3a2 2 0 0 1-2.2 2A19.8 19.8 0 0 1 3.1 5.2 2 2 0 0 1 5.1 3h3a2 2 0 0 1 2 1.7l.5 3a2 2 0 0 1-.6 1.8L8.1 11a16 16 0 0 0 4.9 4.9l1.5-1.9a2 2 0 0 1 1.8-.6l3 .5a2 2 0 0 1 1.7 1.9Z"/>
                    </svg>
                </span>

                <span class="sa-contact-detail-text">
                    <strong>+91 9311036306</strong>
                    <small>Call us anytime</small>
                </span>

            </a>

            {{-- Email --}}
            <a
                href="mailto:softallure.decor@gmail.com"
                class="sa-contact-detail"
            >

                <span class="sa-contact-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <rect x="3" y="5" width="18" height="14" rx="2"/>
                        <path d="m3 7 9 6 9-6"/>
                    </svg>
                </span>

                <span class="sa-contact-detail-text">
                    <strong>softallure.decor@gmail.com</strong>
                    <small>Drop us a message</small>
                </span>

            </a>

            {{-- Location --}}
            <div class="sa-contact-detail">

                <span class="sa-contact-icon">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                        <circle cx="12" cy="10" r="2.5"/>
                    </svg>
                </span>

                <span class="sa-contact-detail-text">
                    <strong>Noida, Uttar Pradesh</strong>
                    <small>Visit our studio</small>
                </span>

            </div>

        </div>

        {{-- Get Quote Button --}}
        <a
            href="{{ route('contact') }}"
            class="sa-contact-quote-btn"
        >
            Get a Quote
            <span aria-hidden="true">→</span>
        </a>

    </div>

</section>




@endsection