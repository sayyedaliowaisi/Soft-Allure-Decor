
@extends('layouts.app')

@section('title', 'About Us | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

{{-- =====================================================
     ABOUT PAGE - HERO SECTION
===================================================== --}}

<section class="sa-about-hero" aria-labelledby="about-hero-title">

    {{-- Background Image --}}
    <div class="sa-about-hero-image" aria-hidden="true">
        <img
            src="{{ asset('images/about/about-hero.jpg') }}"
            alt=""
            fetchpriority="high"
        >
    </div>

    {{-- Overlay --}}
    <div class="sa-about-hero-overlay" aria-hidden="true"></div>

    {{-- Content --}}
    <div class="sa-about-hero-container">

        <div class="sa-about-hero-content">

            <span class="sa-about-hero-eyebrow">
                OUR STORY
            </span>

            <h1 id="about-hero-title">
                About <em>Soft Allure Décor</em>
            </h1>

            <p>
                Creating Beautiful Spaces,
                Inspiring Better Living.
            </p>

            <nav class="sa-about-breadcrumb"
                 aria-label="Breadcrumb">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <span aria-hidden="true">/</span>

                <span aria-current="page">
                    About Us
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =====================================================
     ABOUT PAGE - SECTION 02
     OUR STORY
===================================================== --}}

<section class="sa-about-story" id="our-story">

    <div class="sa-about-story-container">

        {{-- Left Image --}}
        <div class="sa-about-story-image">

            <img
                src="{{ asset('images/about/our-story.jpg') }}"
                alt="Elegant home interior with premium décor"
                loading="lazy"
            >

            <div class="sa-about-story-image-label">
                <span>SOFT ALLURE</span>
                <strong>DÉCOR</strong>
            </div>

        </div>

        {{-- Right Content --}}
        <div class="sa-about-story-content">

            <span class="sa-about-story-eyebrow">
                WHO WE ARE
            </span>

            <h2>
                Crafting Elegant Interiors,
                <em>Creating Timeless Impressions</em>
            </h2>

            <div class="sa-about-story-line"></div>

            <p>
                At Soft Allure Décor, we believe every space
                has a story waiting to be told. Our passion
                lies in bringing together beautiful materials,
                thoughtful design and refined details to
                create interiors that feel truly special.
            </p>

            <p>
                From sophisticated wallpapers and wall panels
                to elegant curtains, designer cushions,
                furniture and customized décor solutions,
                we offer carefully selected products that
                complement both residential and commercial
                spaces.
            </p>

            {{-- Highlights --}}
            <div class="sa-about-story-highlights">

                <div class="sa-about-story-highlight">
                    <span class="sa-about-story-check">✓</span>
                    <span>Premium Quality</span>
                </div>

                <div class="sa-about-story-highlight">
                    <span class="sa-about-story-check">✓</span>
                    <span>Thoughtful Design</span>
                </div>

                <div class="sa-about-story-highlight">
                    <span class="sa-about-story-check">✓</span>
                    <span>Personalized Solutions</span>
                </div>

            </div>

            <a
                href="{{ route('products') }}"
                class="sa-about-story-btn"
            >
                Explore Our Collections
                <span aria-hidden="true">→</span>
            </a>

        </div>

    </div>

</section>



{{-- =====================================================
     ABOUT PAGE - SECTION 03
     OUR MISSION & VISION
===================================================== --}}

<section class="sa-about-purpose" id="mission-vision">

    <div class="sa-about-purpose-container">

        {{-- Section Heading --}}
        <div class="sa-about-purpose-header">

            <span class="sa-about-purpose-eyebrow">
                WHAT DRIVES US
            </span>

            <h2>
                Our Mission <em>&amp; Vision</em>
            </h2>

            <p>
                Guided by creativity, quality and a passion
                for beautiful interiors, we strive to make
                every space feel extraordinary.
            </p>

        </div>

        {{-- Mission & Vision Cards --}}
        <div class="sa-about-purpose-grid">

            {{-- Our Mission --}}
            <article class="sa-about-purpose-card">

                <div class="sa-about-purpose-icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <circle cx="24" cy="24" r="17"/>
                        <circle cx="24" cy="24" r="10"/>
                        <circle cx="24" cy="24" r="3"/>
                        <path d="M24 7V3M24 45v-4M7 24H3M45 24h-4"/>
                    </svg>
                </div>

                <span class="sa-about-purpose-number">
                    01 / OUR PURPOSE
                </span>

                <h3>Our Mission</h3>

                <p>
                    To help individuals, designers and businesses
                    transform their spaces through premium décor
                    products, thoughtful design choices and
                    personalized solutions that balance beauty,
                    comfort and functionality.
                </p>

                <div class="sa-about-purpose-rule"></div>

                <span class="sa-about-purpose-tagline">
                    Beautiful Spaces. Thoughtfully Created.
                </span>

            </article>

            {{-- Our Vision --}}
            <article class="sa-about-purpose-card">

                <div class="sa-about-purpose-icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">

                        <path d="M4 24s8-12 20-12 20 12 20 12-8 12-20 12S4 24 4 24Z"/>
                        <circle cx="24" cy="24" r="6"/>
                        <path d="M24 4v4M24 40v4M6 7l4 4M42 7l-4 4"/>
                    </svg>
                </div>

                <span class="sa-about-purpose-number">
                    02 / OUR AMBITION
                </span>

                <h3>Our Vision</h3>

                <p>
                    To become a trusted destination for refined
                    interior décor, recognized for timeless
                    aesthetics, quality craftsmanship and
                    creative solutions that inspire beautiful
                    living and working environments.
                </p>

                <div class="sa-about-purpose-rule"></div>

                <span class="sa-about-purpose-tagline">
                    Inspiring Interiors. Timeless Impressions.
                </span>

            </article>

        </div>

    </div>

</section>


{{-- =====================================================
     ABOUT PAGE - SECTION 04
     WHAT WE OFFER
===================================================== --}}

<section class="sa-about-offerings" id="what-we-offer">

    <div class="sa-about-offerings-container">

        {{-- Section Heading --}}
        <div class="sa-about-offerings-header">

            <span class="sa-about-offerings-eyebrow">
                OUR EXPERTISE
            </span>

            <h2>
                What We <em>Offer</em>
            </h2>

            <p>
                Explore our thoughtfully curated range of
                décor products designed to bring elegance,
                comfort and personality to every space.
            </p>

        </div>

        {{-- Categories Grid --}}
        <div class="sa-about-offerings-grid">

            {{-- Wallpaper & Wall Panels --}}
            <article class="sa-about-offering-card">

                <a href="{{ route('products') }}"
                   class="sa-about-offering-image"
                   aria-label="Explore Wallpaper and Wall Panels">

                    <img
                        src="{{ asset('images/categories/wall-panels.jpg') }}"
                        alt="Premium wallpaper and decorative wall panels"
                        loading="lazy"
                    >

                </a>

                <div class="sa-about-offering-content">

                    <span class="sa-about-offering-number">
                        01 / COLLECTION
                    </span>

                    <h3>Wallpaper &amp; Wall Panels</h3>

                    <p>
                        Transform ordinary walls into elegant
                        design statements with refined textures,
                        patterns and decorative wall finishes.
                    </p>

                    <a href="{{ route('products') }}"
                       class="sa-about-offering-link">
                        Explore Collection
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </article>

            {{-- Curtains & Furnishings --}}
            <article class="sa-about-offering-card">

                <a href="{{ route('products') }}"
                   class="sa-about-offering-image"
                   aria-label="Explore Curtains and Furnishings">

                    <img
                        src="{{ asset('images/categories/curtains.jpg') }}"
                        alt="Elegant curtains and soft furnishings"
                        loading="lazy"
                    >

                </a>

                <div class="sa-about-offering-content">

                    <span class="sa-about-offering-number">
                        02 / COLLECTION
                    </span>

                    <h3>Curtains &amp; Furnishings</h3>

                    <p>
                        Add warmth, sophistication and comfort
                        with beautiful curtains, premium fabrics
                        and carefully selected furnishings.
                    </p>

                    <a href="{{ route('products') }}"
                       class="sa-about-offering-link">
                        Explore Collection
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </article>

            {{-- Designer Cushions --}}
            <article class="sa-about-offering-card">

                <a href="{{ route('products') }}"
                   class="sa-about-offering-image"
                   aria-label="Explore Designer Cushions">

                    <img
                        src="{{ asset('images/categories/cushions.jpg') }}"
                        alt="Decorative designer cushions on a sofa"
                        loading="lazy"
                    >

                </a>

                <div class="sa-about-offering-content">

                    <span class="sa-about-offering-number">
                        03 / COLLECTION
                    </span>

                    <h3>Designer Cushions</h3>

                    <p>
                        Complete your interiors with stylish
                        cushions that introduce rich textures,
                        elegant colors and finishing touches.
                    </p>

                    <a href="{{ route('products') }}"
                       class="sa-about-offering-link">
                        Explore Collection
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </article>

            {{-- Furniture & Custom Decor --}}
            <article class="sa-about-offering-card">

                <a href="{{ route('products') }}"
                   class="sa-about-offering-image"
                   aria-label="Explore Furniture and Custom Decor">

                    <img
                        src="{{ asset('images/categories/furniture.jpg') }}"
                        alt="Luxury furniture and custom decorative pieces"
                        loading="lazy"
                    >

                </a>

                <div class="sa-about-offering-content">

                    <span class="sa-about-offering-number">
                        04 / COLLECTION
                    </span>

                    <h3>Furniture &amp; Custom Décor</h3>

                    <p>
                        Discover elegant furniture, premium
                        leather finishes and customized décor
                        solutions tailored to your style.
                    </p>

                    <a href="{{ route('products') }}"
                       class="sa-about-offering-link">
                        Explore Collection
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </article>

        </div>

        {{-- Bottom Button --}}
        <div class="sa-about-offerings-footer">

            <a href="{{ route('products') }}"
               class="sa-about-offerings-btn">
                View All Collections
                <span aria-hidden="true">→</span>
            </a>

        </div>

    </div>

</section>



{{-- =====================================================
     ABOUT PAGE - SECTION 05
     WHY CHOOSE US
===================================================== --}}

<section class="sa-about-why" id="why-choose-us">

    <div class="sa-about-why-container">

        {{-- Section Heading --}}
        <div class="sa-about-why-header">

            <span class="sa-about-why-eyebrow">
                THE SOFT ALLURE DIFFERENCE
            </span>

            <h2>
                Why Choose <em>Soft Allure Décor</em>
            </h2>

            <p>
                We bring together carefully selected materials,
                thoughtful design and personalized attention
                to help create spaces that feel exceptional.
            </p>

        </div>

        {{-- Feature Cards --}}
        <div class="sa-about-why-grid">

            {{-- Feature 01 --}}
            <article class="sa-about-why-card">

                <div class="sa-about-why-icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M12 8h24l8 12-20 22L4 20 12 8Z"/>
                        <path d="M4 20h40M18 8l-6 12 12 22 12-22-6-12"/>
                    </svg>
                </div>

                <span class="sa-about-why-number">01</span>

                <h3>Premium Quality</h3>

                <p>
                    Carefully selected décor products,
                    refined textures and quality materials
                    that bring lasting elegance to interiors.
                </p>

            </article>

            {{-- Feature 02 --}}
            <article class="sa-about-why-card">

                <div class="sa-about-why-icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M8 12h32M8 24h32M8 36h32"/>
                        <circle cx="18" cy="12" r="4" fill="#faf8f4"/>
                        <circle cx="32" cy="24" r="4" fill="#faf8f4"/>
                        <circle cx="22" cy="36" r="4" fill="#faf8f4"/>
                    </svg>
                </div>

                <span class="sa-about-why-number">02</span>

                <h3>Customized Solutions</h3>

                <p>
                    Personalized décor choices that
                    complement your preferences, space
                    requirements and individual style.
                </p>

            </article>

            {{-- Feature 03 --}}
            <article class="sa-about-why-card">

                <div class="sa-about-why-icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M7 42V12l17-8 17 8v30"/>
                        <path d="M3 42h42M19 42V30h10v12"/>
                        <path d="M14 16h5M29 16h5M14 24h5M29 24h5"/>
                    </svg>
                </div>

                <span class="sa-about-why-number">03</span>

                <h3>Versatile Spaces</h3>

                <p>
                    Décor solutions suited to residential,
                    commercial and hospitality interiors,
                    from intimate rooms to larger spaces.
                </p>

            </article>

            {{-- Feature 04 --}}
            <article class="sa-about-why-card">

                <div class="sa-about-why-icon" aria-hidden="true">
                    <svg viewBox="0 0 48 48" fill="none"
                         stroke="currentColor" stroke-width="1.5"
                         stroke-linecap="round"
                         stroke-linejoin="round">
                        <path d="M4 17l11-7 9 6 9-6 11 7"/>
                        <path d="M4 17v15l12 8 8-6 8 6 12-8V17"/>
                        <path d="M15 10l9 6 9-6"/>
                        <path d="M16 25l8 6 8-6"/>
                        <path d="M24 16v15"/>
                    </svg>
                </div>

                <span class="sa-about-why-number">04</span>

                <h3>Design Collaboration</h3>

                <p>
                    A thoughtful approach to working with
                    homeowners, designers and project teams
                    to bring creative ideas together.
                </p>

            </article>

        </div>

    </div>

</section>


{{-- =====================================================
     ABOUT PAGE - SECTION 06
     OUR APPROACH
===================================================== --}}

<section class="sa-about-approach" id="our-approach">

    <div class="sa-about-approach-container">

        {{-- Section Heading --}}
        <div class="sa-about-approach-header">

            <span class="sa-about-approach-eyebrow">
                HOW WE WORK
            </span>

            <h2>
                Our <em>Approach</em>
            </h2>

            <p>
                Every beautiful space begins with an idea.
                Our thoughtful process helps bring your
                vision to life, one detail at a time.
            </p>

        </div>

        {{-- Process Timeline --}}
        <div class="sa-about-approach-timeline">

            {{-- Step 01 --}}
            <article class="sa-about-approach-step">

                <div class="sa-about-approach-marker">
                    <span>01</span>
                </div>

                <div class="sa-about-approach-step-content">

                    <span class="sa-about-approach-label">
                        DISCOVER
                    </span>

                    <h3>Consultation</h3>

                    <p>
                        We begin by understanding your
                        ideas, preferences and the
                        unique needs of your space.
                    </p>

                </div>

            </article>

            {{-- Step 02 --}}
            <article class="sa-about-approach-step">

                <div class="sa-about-approach-marker">
                    <span>02</span>
                </div>

                <div class="sa-about-approach-step-content">

                    <span class="sa-about-approach-label">
                        EXPLORE
                    </span>

                    <h3>Product Selection</h3>

                    <p>
                        Explore thoughtfully curated
                        materials, textures, colors
                        and décor collections.
                    </p>

                </div>

            </article>

            {{-- Step 03 --}}
            <article class="sa-about-approach-step">

                <div class="sa-about-approach-marker">
                    <span>03</span>
                </div>

                <div class="sa-about-approach-step-content">

                    <span class="sa-about-approach-label">
                        PERSONALIZE
                    </span>

                    <h3>Customization</h3>

                    <p>
                        We help refine the details
                        and explore suitable options
                        for your style and requirements.
                    </p>

                </div>

            </article>

            {{-- Step 04 --}}
            <article class="sa-about-approach-step">

                <div class="sa-about-approach-marker">
                    <span>04</span>
                </div>

                <div class="sa-about-approach-step-content">

                    <span class="sa-about-approach-label">
                        COMPLETE
                    </span>

                    <h3>Final Styling</h3>

                    <p>
                        Bring the selected elements
                        together to create a cohesive,
                        elegant and inviting space.
                    </p>

                </div>

            </article>

        </div>

    </div>

</section>



{{-- =====================================================
     ABOUT PAGE - SECTION 07
     CONTACT CTA
===================================================== --}}

<section class="sa-about-cta" id="about-contact">

    {{-- Background Image --}}
    <div class="sa-about-cta-image" aria-hidden="true">
        <img
            src="{{ asset('images/about/about-cta.jpg') }}"
            alt=""
            loading="lazy"
        >
    </div>

    {{-- Dark Overlay --}}
    <div class="sa-about-cta-overlay" aria-hidden="true"></div>

    {{-- Content --}}
    <div class="sa-about-cta-container">

        <div class="sa-about-cta-content">

            <span class="sa-about-cta-eyebrow">
                LET'S WORK TOGETHER
            </span>

            <h2>
                Let's Create Something
                <em>Beautiful Together</em>
            </h2>

            <p>
                Your vision deserves a space that feels
                uniquely yours. Explore our premium décor
                collections and let us help bring your
                ideas to life.
            </p>

            <div class="sa-about-cta-actions">

                <a
                    href="{{ route('contact') }}"
                    class="sa-about-cta-btn"
                >
                    Get a Quote
                    <span aria-hidden="true">→</span>
                </a>

                <a
                    href="{{ route('products') }}"
                    class="sa-about-cta-secondary"
                >
                    Explore Our Collections
                    <span aria-hidden="true">↗</span>
                </a>

            </div>

        </div>

    </div>

</section>



@endsection

@push('scripts')
<script src="{{ asset('js/about.js') }}" defer></script>
@endpush
