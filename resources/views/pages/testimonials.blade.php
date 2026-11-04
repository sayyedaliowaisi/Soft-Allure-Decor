
@extends('layouts.app')

@section('title', 'Testimonials | Soft Allure Décor')

@push('styles')
<link
    rel="stylesheet"
    href="{{ asset('css/testimonials.css') }}"
>
@endpush

@section('content')

{{-- =====================================================
     TESTIMONIALS PAGE - SECTION 01
     PREMIUM HERO BANNER
===================================================== --}}

<section
    class="sa-testimonials-hero"
    aria-labelledby="sa-testimonials-hero-title"
>

    {{-- Hero Background --}}
    <div class="sa-testimonials-hero-image"
         aria-hidden="true">

        <img
            src="{{ asset('images/testimonials/testimonials-hero.jpg') }}"
            alt=""
            fetchpriority="high"
        >

    </div>

    {{-- Overlay --}}
    <div class="sa-testimonials-hero-overlay"
         aria-hidden="true"></div>

    <div class="sa-testimonials-hero-container">

        <div class="sa-testimonials-hero-content">

            <span class="sa-testimonials-hero-eyebrow">
                CLIENT EXPERIENCES
            </span>

            <h1 id="sa-testimonials-hero-title">
                Words From <em>Our Clients</em>
            </h1>

            <p>
                Explore the experiences and feedback
                shared by people who have connected
                with Soft Allure Décor.
            </p>

            {{-- Breadcrumb --}}
            <nav
                class="sa-testimonials-breadcrumb"
                aria-label="Breadcrumb"
            >

                <a href="{{ route('home') }}">
                    Home
                </a>

                <span aria-hidden="true">/</span>

                <span aria-current="page">
                    Testimonials
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =====================================================
     TESTIMONIALS PAGE - SECTION 02
     CLIENT REVIEWS GRID
===================================================== --}}

<section
    class="sa-testimonials-main"
    id="client-reviews"
    aria-labelledby="sa-testimonials-main-title"
>
    <div class="sa-testimonials-main-container">

        {{-- Heading --}}
        <div class="sa-testimonials-main-heading">

            <span class="sa-testimonials-main-eyebrow">
                CLIENT STORIES
            </span>

            <h2 id="sa-testimonials-main-title">
                Experiences That <em>Matter</em>
            </h2>

            <p>
                Discover what our customers have shared
                about their experience with Soft Allure Décor.
            </p>

        </div>

        @if($testimonials->count())

            <div class="sa-testimonials-grid">

                @foreach($testimonials as $testimonial)

                    <article class="sa-testimonial-card">

                        <div class="sa-testimonial-card-top">

                            <span
                                class="sa-testimonial-quote-icon"
                                aria-hidden="true"
                            >
                                &ldquo;
                            </span>

                            <div
                                class="sa-testimonial-rating"
                                aria-label="{{ $testimonial->rating }} out of 5 stars"
                            >
                                @for($star = 1; $star <= 5; $star++)
                                    <span
                                        class="{{ $star <= $testimonial->rating ? 'filled' : 'empty' }}"
                                        aria-hidden="true"
                                    >
                                        ★
                                    </span>
                                @endfor
                            </div>

                        </div>

                        <p class="sa-testimonial-message">
                            {{ $testimonial->message }}
                        </p>

                        <div class="sa-testimonial-card-footer">

                            <span
                                class="sa-testimonial-avatar"
                                aria-hidden="true"
                            >
                                {{ mb_strtoupper(mb_substr($testimonial->name, 0, 1)) }}
                            </span>

                            <div class="sa-testimonial-author">

                                <h3>
                                    {{ $testimonial->name }}
                                </h3>

                                @if($testimonial->city)
                                    <span>
                                        {{ $testimonial->city }}
                                    </span>
                                @else
                                    <span>Customer</span>
                                @endif

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

            {{-- Pagination --}}
            @if($testimonials->hasPages())

                <nav
                    class="sa-testimonials-pagination"
                    aria-label="Testimonials pagination"
                >
                    @if($testimonials->onFirstPage())
                        <span class="disabled">
                            ← Previous
                        </span>
                    @else
                        <a href="{{ $testimonials->previousPageUrl() }}#client-reviews">
                            ← Previous
                        </a>
                    @endif

                    <span>
                        Page {{ $testimonials->currentPage() }}
                        of {{ $testimonials->lastPage() }}
                    </span>

                    @if($testimonials->hasMorePages())
                        <a href="{{ $testimonials->nextPageUrl() }}#client-reviews">
                            Next →
                        </a>
                    @else
                        <span class="disabled">
                            Next →
                        </span>
                    @endif
                </nav>

            @endif

        @else

            {{-- No approved reviews yet --}}
            <div class="sa-testimonials-empty">

                <div
                    class="sa-testimonials-empty-icon"
                    aria-hidden="true"
                >
                    &ldquo;
                </div>

                <h3>
                    Client Stories Coming Soon
                </h3>

                <p>
                    We're preparing this space for genuine
                    customer experiences. Please check back
                    for updates.
                </p>

            </div>

        @endif

    </div>
</section>


{{-- =====================================================
     TESTIMONIALS PAGE - SECTION 03
     SHARE YOUR EXPERIENCE
===================================================== --}}

<section
    class="sa-review-section"
    id="share-experience"
    aria-labelledby="sa-review-title"
>

    <div class="sa-review-container">

        {{-- Section Heading --}}
        <div class="sa-review-heading">

            <span class="sa-review-eyebrow">
                YOUR VOICE MATTERS
            </span>

            <h2 id="sa-review-title">
                Share Your <em>Experience</em>
            </h2>

            <p>
                Have you worked with Soft Allure Décor?
                We'd love to hear about your experience.
            </p>

        </div>

        <div class="sa-review-form-card">

            {{-- Success Message --}}
            @if(session('review_success'))
                <div
                    class="sa-review-alert sa-review-alert-success"
                    role="status"
                >
                    {{ session('review_success') }}
                </div>
            @endif

            {{-- Validation Summary --}}
            @if($errors->any())
                <div
                    class="sa-review-alert sa-review-alert-error"
                    role="alert"
                >
                    Please check the form fields and try again.
                </div>
            @endif

            <form
                action="{{ route('testimonials.store') }}"
                method="POST"
                class="sa-review-form"
                id="sa-review-form"
            >
                @csrf

                {{-- Honeypot Spam Protection --}}
                <div class="sa-review-honeypot"
                     aria-hidden="true">

                    <label for="review_website">
                        Website
                    </label>

                    <input
                        type="text"
                        name="website"
                        id="review_website"
                        tabindex="-1"
                        autocomplete="off"
                    >

                </div>

                {{-- Name and City --}}
                <div class="sa-review-form-grid">

                    <div class="sa-review-field">

                        <label for="review_name">
                            Full Name <span>*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="review_name"
                            value="{{ old('name') }}"
                            placeholder="Enter your name"
                            autocomplete="name"
                            maxlength="100"
                            required
                        >

                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="sa-review-field">

                        <label for="review_city">
                            City
                        </label>

                        <input
                            type="text"
                            name="city"
                            id="review_city"
                            value="{{ old('city') }}"
                            placeholder="Enter your city"
                            maxlength="100"
                        >

                        @error('city')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                {{-- Star Rating --}}
                <fieldset class="sa-review-rating-field">

                    <legend>
                        Your Rating <span>*</span>
                    </legend>

                    <div class="sa-review-rating-options">

                        @for($star = 5; $star >= 1; $star--)

                            <input
                                type="radio"
                                name="rating"
                                id="review_star_{{ $star }}"
                                value="{{ $star }}"
                                @checked(old('rating') == $star)
                                required
                            >

                            <label
                                for="review_star_{{ $star }}"
                                title="{{ $star }} star{{ $star > 1 ? 's' : '' }}"
                                aria-label="{{ $star }} out of 5 stars"
                            >
                                ★
                            </label>

                        @endfor

                    </div>

                    <p class="sa-review-rating-hint">
                        Select a rating from 1 to 5 stars.
                    </p>

                    @error('rating')
                        <small>{{ $message }}</small>
                    @enderror

                </fieldset>

                {{-- Review Message --}}
                <div class="sa-review-field">

                    <label for="review_message">
                        Your Feedback <span>*</span>
                    </label>

                    <textarea
                        name="message"
                        id="review_message"
                        rows="5"
                        minlength="10"
                        maxlength="2000"
                        placeholder="Tell us about your experience with our products or services..."
                        required
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <small>{{ $message }}</small>
                    @enderror

                </div>

                {{-- Submission --}}
                <div class="sa-review-form-bottom">

                    <button
                        type="submit"
                        class="sa-review-submit"
                        id="sa-review-submit"
                    >
                        <span id="sa-review-submit-label">
                            Submit Your Review
                        </span>

                        <span aria-hidden="true">→</span>
                    </button>

                    <p>
                        Your review will be checked before
                        appearing on our website.
                    </p>

                </div>

            </form>

        </div>

    </div>

</section>


{{-- =====================================================
     TESTIMONIALS PAGE - SECTION 04
     FINAL GET A QUOTE CTA
===================================================== --}}

<section
    class="sa-testimonials-final-cta"
    aria-labelledby="sa-testimonials-final-title"
>
    <div class="sa-testimonials-final-container">

        <div class="sa-testimonials-final-content">

            <span class="sa-testimonials-final-eyebrow">
                LET'S CREATE SOMETHING BEAUTIFUL
            </span>

            <h2 id="sa-testimonials-final-title">
                Your Dream Space
                <em>Starts Here</em>
            </h2>

            <p>
                Discover thoughtfully selected décor and
                furnishings to bring your vision to life.
                Share your requirements and connect with
                our team to explore the possibilities.
            </p>

            <div class="sa-testimonials-final-actions">

                {{-- Get a Quote --}}
                <a
                    href="{{ route('get-a-quote') }}"
                    class="sa-testimonials-final-btn sa-testimonials-final-primary"
                >
                    <span>Get a Quote</span>
                    <span aria-hidden="true">↗</span>
                </a>

                {{-- Contact --}}
                <a
                    href="{{ route('contact') }}"
                    class="sa-testimonials-final-btn sa-testimonials-final-outline"
                >
                    <span>Contact Us</span>
                    <span aria-hidden="true">↗</span>
                </a>

            </div>

        </div>

    </div>
</section>



{{-- NEXT SECTION 02 - CLIENT TESTIMONIALS GRID --}}

@endsection

@push('scripts')
<script
    src="{{ asset('js/testimonials.js') }}"
    defer
></script>
@endpush
