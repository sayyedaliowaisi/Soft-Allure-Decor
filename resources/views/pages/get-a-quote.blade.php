
@extends('layouts.app')

@section('title', 'Get a Quote | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/get-a-quote.css') }}">
<link rel="stylesheet" href="{{ asset('css/enquiry-system.css') }}">
@endpush

@section('content')

{{-- ==============================================
     SECTION 01 - PREMIUM HERO
============================================== --}}

<section class="sa-quote-hero" aria-labelledby="sa-quote-hero-title">

    <div class="sa-quote-hero-image" aria-hidden="true">
        <img
            src="{{ asset('images/quote/quote-hero.jpg') }}"
            alt=""
            fetchpriority="high"
        >
    </div>

    <div class="sa-quote-hero-overlay" aria-hidden="true"></div>

    <div class="sa-quote-hero-container">
        <div class="sa-quote-hero-content">

            <span class="sa-quote-hero-eyebrow">
                TAILORED DÉCOR SOLUTIONS
            </span>

            <h1 id="sa-quote-hero-title">
                Request a <em>Quote</em>
            </h1>

            <p>
                Tell us about your décor requirements.
                Our team will help you explore suitable
                products and personalised solutions.
            </p>

            <nav
                class="sa-quote-breadcrumb"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('home') }}">Home</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page">Get a Quote</span>
            </nav>

        </div>
    </div>

</section>


{{-- ==============================================
     SECTION 02 - QUOTE REQUEST FORM
============================================== --}}

<section class="sa-quote-main" id="quote-request">

    <div class="sa-quote-main-container">

        <div class="sa-quote-form-heading">

            <span class="sa-quote-section-eyebrow">
                PERSONALISED QUOTATION
            </span>

            <h2>
                Tell Us About <em>Your Project</em>
            </h2>

            <p>
                Share your décor requirements and our team
                will review your enquiry.
            </p>

        </div>

        <div class="sa-quote-form-card">

            {{-- SUCCESS MESSAGE --}}
            @if(session('quote_success'))
                <div
                    class="sa-quote-alert sa-quote-alert-success"
                    id="saQuoteSuccess"
                    role="status"
                >
                    {{ session('quote_success') }}
                </div>
            @endif

            {{-- VALIDATION ERRORS --}}
            @if($errors->any())
                {{-- Used by enquiry-system.js to prioritize old submitted products. --}}
                <span id="saQuoteValidationFailed" hidden></span>
                <div
                    class="sa-quote-alert sa-quote-alert-error"
                    role="alert"
                >
                    <strong>Please check your information.</strong>

                    <p>
                        Correct the highlighted fields and
                        submit your request again.
                    </p>

                    @if($errors->has('form'))
                        <p>{{ $errors->first('form') }}</p>
                    @endif
                </div>
            @endif

            <form
                action="{{ route('get-a-quote.submit') }}"
                method="POST"
                enctype="multipart/form-data"
                class="sa-quote-form"
                id="sa-quote-form"
            >
                @csrf

                {{-- SELECTED PRODUCTS JSON --}}
                <input
                    type="hidden"
                    name="products_json"
                    id="saSelectedProductsJson"
                    value="{{ old('products_json') }}"
                >

                {{-- HONEYPOT --}}
                <div
                    class="sa-quote-honeypot"
                    aria-hidden="true"
                >
                    <label for="quote_website">Website</label>

                    <input
                        type="text"
                        name="website"
                        id="quote_website"
                        tabindex="-1"
                        autocomplete="off"
                    >
                </div>


                {{-- ======================================
                     01 - CONTACT INFORMATION
                ====================================== --}}

                <h3 class="sa-quote-form-group-title">
                    <span>01</span> Contact Information
                </h3>

                <div class="sa-quote-form-grid">

                    {{-- FULL NAME --}}
                    <div class="sa-quote-field">
                        <label for="quote_name">
                            Full Name <span>*</span>
                        </label>

                        <input
                            id="quote_name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Your full name"
                            autocomplete="name"
                            maxlength="100"
                            required
                        >

                        @error('name')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="sa-quote-field">
                        <label for="quote_email">
                            Email Address <span>*</span>
                        </label>

                        <input
                            id="quote_email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                            maxlength="150"
                            required
                        >

                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div class="sa-quote-field">
                        <label for="quote_phone">
                            Phone Number <span>*</span>
                        </label>

                        <input
                            id="quote_phone"
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+91 XXXXX XXXXX"
                            autocomplete="tel"
                            maxlength="20"
                            required
                        >

                        @error('phone')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- CITY --}}
                    <div class="sa-quote-field">
                        <label for="quote_city">
                            City
                        </label>

                        <input
                            id="quote_city"
                            type="text"
                            name="city"
                            value="{{ old('city') }}"
                            placeholder="Your city"
                            maxlength="100"
                        >

                        @error('city')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                </div>


                {{-- ======================================
                     02 - SELECTED PRODUCTS
                ====================================== --}}

                <h3 class="sa-quote-form-group-title">
                    <span>02</span> Selected Products
                </h3>

                <section
                    class="sa-enquiry-section"
                    aria-labelledby="saEnquiryTitle"
                >

                    <div class="sa-enquiry-heading">

                        <div>
                            <span class="sa-enquiry-eyebrow">
                                YOUR SELECTED COLLECTION
                            </span>

                            <h3 id="saEnquiryTitle">
                                Products in Your Enquiry

                                <span id="saEnquiryCount">0</span>
                            </h3>

                            <p>
                                Review your selected products,
                                update quantities or remove items
                                before requesting a quotation.
                            </p>
                        </div>

                        <a
                            href="{{ route('products') }}"
                            class="sa-enquiry-browse"
                        >
                            + Browse Products
                        </a>

                    </div>

                    {{-- DYNAMIC PRODUCT ITEMS --}}
                    <div
                        id="saEnquiryItems"
                        class="sa-enquiry-items"
                        aria-live="polite"
                    ></div>

                    {{-- EMPTY STATE --}}
                    <div
                        id="saEnquiryEmpty"
                        class="sa-enquiry-empty"
                        hidden
                    >
                        <p>No products added yet.</p>

                        <span>
                            Explore our collection or continue
                            with a custom quotation request below.
                        </span>
                    </div>

                    {{-- SUMMARY --}}
                    <div
                        class="sa-enquiry-summary"
                        id="saEnquirySummary"
                        hidden
                    >
                        <span>Total Selected Products</span>

                        <strong id="saEnquirySummaryCount">
                            0
                        </strong>
                    </div>

                    @error('products_json')
                        <small class="sa-enquiry-error">
                            {{ $message }}
                        </small>
                    @enderror

                </section>


                {{-- ======================================
                     03 - PROJECT REQUIREMENTS
                ====================================== --}}

                <h3 class="sa-quote-form-group-title">
                    <span>03</span> Project Requirements
                </h3>

                <div class="sa-quote-form-grid">

                    {{-- CATEGORY --}}
                    <div class="sa-quote-field">

                        <label for="quote_category">
                            Product Category <span>*</span>
                        </label>

                        <select
                            id="quote_category"
                            name="category"
                            required
                        >
                            <option value="">
                                Select a category
                            </option>

                            @foreach([
                                'Curtains & Blinds',
                                'Wall Décor',
                                'Upholstery',
                                'Home Furnishings',
                                'Custom Décor',
                                'Multiple Categories',
                                'Other'
                            ] as $category)

                                <option
                                    value="{{ $category }}"
                                    @selected(old('category') === $category)
                                >
                                    {{ $category }}
                                </option>

                            @endforeach
                        </select>

                        @error('category')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    {{-- QUANTITY --}}
                    <div class="sa-quote-field">

                        <label for="quote_quantity">
                            Estimated Total Quantity
                        </label>

                        <input
                            id="quote_quantity"
                            type="number"
                            name="quantity"
                            min="1"
                            max="100000"
                            value="{{ old('quantity', request()->query('quantity')) }}"
                            placeholder="Enter total quantity"
                        >

                        @error('quantity')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    {{-- BUDGET --}}
                    <div class="sa-quote-field">

                        <label for="quote_budget">
                            Estimated Budget
                        </label>

                        <select
                            id="quote_budget"
                            name="budget"
                        >
                            <option value="">
                                Select budget (optional)
                            </option>

                            @foreach([
                                'Below ₹25,000',
                                '₹25,000 - ₹50,000',
                                '₹50,000 - ₹1,00,000',
                                '₹1,00,000 - ₹3,00,000',
                                'Above ₹3,00,000',
                                'Not Decided'
                            ] as $budget)

                                <option
                                    value="{{ $budget }}"
                                    @selected(old('budget') === $budget)
                                >
                                    {{ $budget }}
                                </option>

                            @endforeach

                        </select>

                        @error('budget')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                    {{-- TIMELINE --}}
                    <div class="sa-quote-field">

                        <label for="quote_timeline">
                            Project Timeline
                        </label>

                        <select
                            id="quote_timeline"
                            name="timeline"
                        >
                            <option value="">
                                Select timeline (optional)
                            </option>

                            @foreach([
                                'As Soon As Possible',
                                'Within 1 Month',
                                'Within 1-3 Months',
                                'After 3 Months',
                                'Just Exploring'
                            ] as $timeline)

                                <option
                                    value="{{ $timeline }}"
                                    @selected(old('timeline') === $timeline)
                                >
                                    {{ $timeline }}
                                </option>

                            @endforeach

                        </select>

                        @error('timeline')
                            <small>{{ $message }}</small>
                        @enderror

                    </div>

                </div>


                {{-- PROJECT MESSAGE --}}
                <div class="sa-quote-field">

                    <label for="quote_message">
                        Project Requirements <span>*</span>
                    </label>

                    <textarea
                        id="quote_message"
                        name="message"
                        rows="5"
                        maxlength="3000"
                        placeholder="Tell us about the products, dimensions, materials, colours, finishes or customisation you need..."
                        required
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <small>{{ $message }}</small>
                    @enderror

                </div>


                {{-- ATTACHMENT --}}
                <div class="sa-quote-field">

                    <label for="quote_attachment">
                        Reference Image / PDF

                        <span class="sa-quote-optional">
                            (Optional)
                        </span>
                    </label>

                    <div class="sa-quote-upload">

                        <input
                            type="file"
                            id="quote_attachment"
                            name="attachment"
                            accept=".jpg,.jpeg,.png,.webp,.pdf"
                            aria-describedby="sa-quote-file-help"
                        >

                        <p id="sa-quote-file-help">
                            JPG, PNG, WEBP or PDF · Maximum 5 MB
                        </p>

                        <span
                            id="sa-quote-file-name"
                            aria-live="polite"
                        ></span>

                    </div>

                    @error('attachment')
                        <small>{{ $message }}</small>
                    @enderror

                </div>


                {{-- SUBMIT --}}
                <div class="sa-quote-form-bottom">

                    <button
                        type="submit"
                        class="sa-quote-submit"
                        id="sa-quote-submit"
                    >
                        <span id="sa-quote-submit-label">
                            Submit Quote Request
                        </span>

                        <span aria-hidden="true">→</span>
                    </button>

                    <p>
                        We'll use your details only to respond
                        to your quotation enquiry.
                    </p>

                </div>

            </form>

        </div>

    </div>

</section>


{{-- ==============================================
     SECTION 03 - HOW IT WORKS
============================================== --}}

<section
    class="sa-quote-process"
    id="quote-process"
    aria-labelledby="sa-quote-process-title"
>

    <div class="sa-quote-process-container">

        <div class="sa-quote-process-heading">

            <span class="sa-quote-process-eyebrow">
                OUR SIMPLE PROCESS
            </span>

            <h2 id="sa-quote-process-title">
                How It <em>Works</em>
            </h2>

            <p>
                Getting started is simple. Share your
                requirements and we'll guide you
                through the next steps.
            </p>

        </div>

        <div class="sa-quote-process-grid">

            {{-- STEP 01 --}}
            <article class="sa-quote-process-card">

                <span class="sa-quote-process-number">
                    01
                </span>

                <div class="sa-quote-process-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        aria-hidden="true"
                    >
                        <rect
                            x="5"
                            y="4"
                            width="14"
                            height="17"
                            rx="2"
                        />
                        <path d="M9 4.5h6M9 10h6M9 14h6"/>
                    </svg>
                </div>

                <h3>Share Your Requirements</h3>

                <p>
                    Fill out the quotation form with your
                    product preferences, quantity and
                    project details.
                </p>

            </article>


            {{-- STEP 02 --}}
            <article class="sa-quote-process-card">

                <span class="sa-quote-process-number">
                    02
                </span>

                <div class="sa-quote-process-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        aria-hidden="true"
                    >
                        <circle
                            cx="10.5"
                            cy="10.5"
                            r="6.5"
                        />
                        <path
                            d="m16 16 5 5M8 10.5l2 2 4-4"
                        />
                    </svg>
                </div>

                <h3>Our Team Reviews</h3>

                <p>
                    Our team reviews your enquiry
                    and may contact you if additional
                    information is needed.
                </p>

            </article>


            {{-- STEP 03 --}}
            <article class="sa-quote-process-card">

                <span class="sa-quote-process-number">
                    03
                </span>

                <div class="sa-quote-process-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        aria-hidden="true"
                    >
                        <path
                            d="M7 3h7l5 5v13H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"
                        />
                        <path
                            d="M14 3v6h5M9 13h6M9 17h6"
                        />
                    </svg>
                </div>

                <h3>Receive Your Quotation</h3>

                <p>
                    Once your requirements are clarified,
                    our team can share a quotation
                    based on your needs.
                </p>

            </article>

        </div>

    </div>

</section>


{{-- ==============================================
     SECTION 04 - FINAL ASSISTANCE CTA
============================================== --}}

<section
    class="sa-quote-final-cta"
    id="quote-assistance"
    aria-labelledby="sa-quote-final-title"
>

    <div class="sa-quote-final-container">

        <div class="sa-quote-final-content">

            <span class="sa-quote-final-eyebrow">
                WE'RE HERE TO HELP
            </span>

            <h2 id="sa-quote-final-title">
                Need Help With Your
                <em>Requirements?</em>
            </h2>

            <p>
                Have questions about products,
                customisation or your project?
                Connect with our team to discuss
                your décor requirements.
            </p>

            <div class="sa-quote-final-actions">

                {{-- CALL --}}
                <a
                    href="tel:+919311036306"
                    class="sa-quote-final-btn sa-quote-final-btn-primary"
                    aria-label="Call Soft Allure Décor"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.96.35 1.9.68 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.25a2 2 0 0 1 2.11-.45c.91.33 1.85.56 2.81.68A2 2 0 0 1 22 16.92z"
                        />
                    </svg>

                    <span>Call Now</span>
                </a>

                {{-- WHATSAPP --}}
                <a
                    href="https://wa.me/919311036306?text=Hello%20Soft%20Allure%20Decor%2C%20I%20need%20assistance%20with%20a%20quotation."
                    class="sa-quote-final-btn sa-quote-final-btn-outline"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="Chat with Soft Allure Décor on WhatsApp"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path
                            d="M21 11.5a8.5 8.5 0 0 1-12.4 7.55L3 21l1.95-5.6A8.5 8.5 0 1 1 21 11.5z"
                        />
                        <path
                            d="M9 8.5c.5 3 2.5 5 6 6.5"
                        />
                    </svg>

                    <span>WhatsApp Us</span>
                </a>

            </div>

        </div>

    </div>

</section>

@endsection

@push('scripts')
<script src="{{ asset('js/get-a-quote.js') }}" defer></script>
<script src="{{ asset('js/enquiry-system.js') }}" defer></script>
@endpush
