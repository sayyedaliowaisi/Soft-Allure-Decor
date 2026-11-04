
@extends('layouts.app')

@section('title', 'Gallery & Projects | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endpush

@section('content')

{{-- =====================================================
     GALLERY PAGE - SECTION 01
     PREMIUM HERO BANNER
===================================================== --}}

<section class="sa-gallery-hero"
         aria-labelledby="sa-gallery-hero-title">

    {{-- Background Image --}}
    <div class="sa-gallery-hero-image" aria-hidden="true">

        <img
            src="{{ asset('images/gallery/gallery-hero.jpg') }}"
            alt=""
            fetchpriority="high"
        >

    </div>

    {{-- Dark Overlay --}}
    <div class="sa-gallery-hero-overlay"
         aria-hidden="true"></div>

    {{-- Hero Content --}}
    <div class="sa-gallery-hero-container">

        <div class="sa-gallery-hero-content">

            <span class="sa-gallery-hero-eyebrow">
                OUR PORTFOLIO
            </span>

            <h1 id="sa-gallery-hero-title">
                Our Projects <em>&amp; Gallery</em>
            </h1>

            <p>
                Discover inspiring spaces, refined details
                and beautiful décor ideas.
            </p>

            {{-- Breadcrumb --}}
            <nav class="sa-gallery-breadcrumb"
                 aria-label="Breadcrumb">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <span class="sa-gallery-breadcrumb-divider"
                      aria-hidden="true">
                    /
                </span>

                <span aria-current="page">
                    Gallery
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =====================================================
     GALLERY PAGE - SECTION 02
     PROJECT GALLERY & CATEGORY FILTERS
===================================================== --}}

<section class="sa-projects" id="our-projects"
         aria-labelledby="sa-projects-title">

    <div class="sa-projects-container">

        {{-- Section Heading --}}
        <div class="sa-projects-heading">

            <span class="sa-projects-eyebrow">
                EXPLORE OUR WORK
            </span>

            <h2 id="sa-projects-title">
                Spaces That <em>Inspire</em>
            </h2>

            <p>
                Explore our collection of beautiful interiors,
                thoughtfully selected materials and décor details.
            </p>

        </div>

        {{-- Category Filters --}}
        <div class="sa-projects-filters"
             role="group"
             aria-label="Filter gallery by category">

            <button type="button"
                    class="sa-projects-filter is-active"
                    data-filter="all"
                    aria-pressed="true">
                All Projects
            </button>

            <button type="button"
                    class="sa-projects-filter"
                    data-filter="residential"
                    aria-pressed="false">
                Residential
            </button>

            <button type="button"
                    class="sa-projects-filter"
                    data-filter="commercial"
                    aria-pressed="false">
                Commercial
            </button>

            <button type="button"
                    class="sa-projects-filter"
                    data-filter="hospitality"
                    aria-pressed="false">
                Hospitality
            </button>

            <button type="button"
                    class="sa-projects-filter"
                    data-filter="custom"
                    aria-pressed="false">
                Custom Décor
            </button>

        </div>

        {{-- Gallery Grid --}}
        <div class="sa-projects-grid" id="sa-projects-grid">

            {{-- Item 01 --}}
            <article class="sa-project-card"
                     data-category="residential">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Contemporary Living Space image">

                    <img
                        src="{{ asset('images/gallery/residential-01.jpg') }}"
                        alt="Contemporary living room interior"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            RESIDENTIAL
                        </span>
                        <span class="sa-project-card-title">
                            Contemporary Living Space
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 02 --}}
            <article class="sa-project-card"
                     data-category="commercial">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Modern Workspace image">

                    <img
                        src="{{ asset('images/gallery/commercial-01.jpg') }}"
                        alt="Modern commercial workspace interior"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            COMMERCIAL
                        </span>
                        <span class="sa-project-card-title">
                            Modern Workspace
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 03 --}}
            <article class="sa-project-card"
                     data-category="hospitality">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Elegant Guest Suite image">

                    <img
                        src="{{ asset('images/gallery/hospitality-01.jpg') }}"
                        alt="Elegant hospitality bedroom interior"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            HOSPITALITY
                        </span>
                        <span class="sa-project-card-title">
                            Elegant Guest Suite
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 04 --}}
            <article class="sa-project-card"
                     data-category="residential">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Refined Bedroom Interior image">

                    <img
                        src="{{ asset('images/gallery/residential-02.jpg') }}"
                        alt="Bedroom interior with decorative wall panels"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            RESIDENTIAL
                        </span>
                        <span class="sa-project-card-title">
                            Refined Bedroom Interior
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 05 --}}
            <article class="sa-project-card"
                     data-category="commercial">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Contemporary Dining Interior image">

                    <img
                        src="{{ asset('images/gallery/commercial-02.jpg') }}"
                        alt="Contemporary dining area interior"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            COMMERCIAL
                        </span>
                        <span class="sa-project-card-title">
                            Contemporary Dining Interior
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 06 --}}
            <article class="sa-project-card"
                     data-category="custom">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Bespoke Décor Details image">

                    <img
                        src="{{ asset('images/gallery/custom-01.jpg') }}"
                        alt="Custom curtains, cushions and décor details"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            CUSTOM DÉCOR
                        </span>
                        <span class="sa-project-card-title">
                            Bespoke Décor Details
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 07 --}}
            <article class="sa-project-card"
                     data-category="hospitality">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Warm Hospitality Interior image">

                    <img
                        src="{{ asset('images/gallery/hospitality-02.jpg') }}"
                        alt="Warm hospitality interior design"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            HOSPITALITY
                        </span>
                        <span class="sa-project-card-title">
                            Warm Hospitality Interior
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

            {{-- Item 08 --}}
            <article class="sa-project-card"
                     data-category="custom">

                <button type="button"
                        class="sa-project-card-button"
                        aria-label="View Signature Wall Styling image">

                    <img
                        src="{{ asset('images/gallery/custom-02.jpg') }}"
                        alt="Custom decorative wall styling"
                        loading="lazy"
                    >

                    <span class="sa-project-card-overlay">
                        <span class="sa-project-card-category">
                            CUSTOM DÉCOR
                        </span>
                        <span class="sa-project-card-title">
                            Signature Wall Styling
                        </span>
                        <span class="sa-project-card-view">
                            View Image ↗
                        </span>
                    </span>

                </button>

            </article>

        </div>

        {{-- Filter Empty State --}}
        <p class="sa-projects-empty" id="sa-projects-empty" hidden>
            No gallery images are available in this category yet.
        </p>

        {{-- Results Count --}}
        <p class="sa-projects-count"
           id="sa-projects-count"
           role="status"
           aria-live="polite">
            Showing 8 images
        </p>

    </div>

</section>


{{-- =====================================================
     GALLERY PAGE - SECTION 03
     FULLSCREEN IMAGE LIGHTBOX
===================================================== --}}

<div
    class="sa-gallery-lightbox"
    id="sa-gallery-lightbox"
    role="dialog"
    aria-modal="true"
    aria-label="Gallery image viewer"
    aria-hidden="true"
    tabindex="-1"
    hidden
>

    {{-- Close Button --}}
    <button
        type="button"
        class="sa-lightbox-close"
        id="sa-lightbox-close"
        aria-label="Close image viewer"
    >
        &times;
    </button>

    {{-- Previous Button --}}
    <button
        type="button"
        class="sa-lightbox-arrow sa-lightbox-prev"
        id="sa-lightbox-prev"
        aria-label="Previous image"
    >
        &#10094;
    </button>

    {{-- Main Content --}}
    <div class="sa-lightbox-content">

        <div class="sa-lightbox-image-wrap">

            <img
                src=""
                alt=""
                class="sa-lightbox-image"
                id="sa-lightbox-image"
            >

        </div>

        <div class="sa-lightbox-info">

            <span
                class="sa-lightbox-category"
                id="sa-lightbox-category"
            ></span>

            <h3 id="sa-lightbox-title"></h3>

            <span
                class="sa-lightbox-counter"
                id="sa-lightbox-counter"
            ></span>

        </div>

    </div>

    {{-- Next Button --}}
    <button
        type="button"
        class="sa-lightbox-arrow sa-lightbox-next"
        id="sa-lightbox-next"
        aria-label="Next image"
    >
        &#10095;
    </button>

</div>


{{-- =====================================================
     GALLERY PAGE - SECTION 04
     FEATURED PROJECT / DESIGN INSPIRATION
===================================================== --}}

<section
    class="sa-gallery-featured"
    id="featured-project"
    aria-labelledby="sa-gallery-featured-title"
>

    <div class="sa-gallery-featured-container">

        {{-- Left: Featured Image --}}
        <div class="sa-gallery-featured-visual">

            <img
                src="{{ asset('images/gallery/featured-project.jpg') }}"
                alt="Elegant living room with refined furniture, wall finishes and soft furnishings"
                loading="lazy"
            >

            <span class="sa-gallery-featured-image-label">
                CURATED DESIGN INSPIRATION
            </span>

        </div>

        {{-- Right: Featured Content --}}
        <div class="sa-gallery-featured-content">

            <span class="sa-gallery-featured-eyebrow">
                THE ART OF BEAUTIFUL LIVING
            </span>

            <h2 id="sa-gallery-featured-title">
                Where Elegance
                <em>Meets Comfort</em>
            </h2>

            <div class="sa-gallery-featured-divider"></div>

            <p class="sa-gallery-featured-description">
                Every beautiful interior begins with thoughtful
                details. From refined textures and coordinated
                furnishings to statement wall finishes, the right
                elements can transform the character of a space.
            </p>

            <p class="sa-gallery-featured-description">
                Discover décor inspiration that balances
                timeless aesthetics with everyday comfort.
            </p>

            {{-- Design Highlights --}}
            <div class="sa-gallery-featured-highlights">

                <div class="sa-gallery-featured-highlight">
                    <span class="sa-gallery-featured-dot"></span>
                    <span>Refined Materials</span>
                </div>

                <div class="sa-gallery-featured-highlight">
                    <span class="sa-gallery-featured-dot"></span>
                    <span>Elegant Finishes</span>
                </div>

                <div class="sa-gallery-featured-highlight">
                    <span class="sa-gallery-featured-dot"></span>
                    <span>Thoughtful Styling</span>
                </div>

            </div>

            {{-- CTA --}}
            <a
                href="#our-projects"
                class="sa-gallery-featured-btn"
            >
                Explore Our Gallery

                <span aria-hidden="true">
                    →
                </span>
            </a>

        </div>

    </div>

</section>


{{-- =====================================================
     GALLERY PAGE - SECTION 05
     FINAL CONTACT CTA
===================================================== --}}

<section
    class="sa-gallery-contact"
    id="gallery-contact"
    aria-labelledby="sa-gallery-contact-title"
>

    <div class="sa-gallery-contact-container">

        <div class="sa-gallery-contact-content">

            <span class="sa-gallery-contact-eyebrow">
                LET'S CREATE TOGETHER
            </span>

            <h2 id="sa-gallery-contact-title">
                Have a Space <em>in Mind?</em>
            </h2>

            <p>
                Whether you're refreshing a single room or
                exploring décor ideas for an entire space,
                we'd love to hear your vision.
            </p>

            <a
                href="{{ route('contact') }}"
                class="sa-gallery-contact-btn"
            >
                Discuss Your Project

                <span aria-hidden="true">→</span>
            </a>

        </div>

    </div>

</section>



{{-- =====================================================
     NEXT: SECTION 02 - PROJECT GALLERY & FILTERS
===================================================== --}}

@endsection

@push('scripts')
<script src="{{ asset('js/gallery.js') }}" defer></script>
@endpush
