
@extends('layouts.app')

@section('title', 'Contact Us | Soft Allure Décor')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endpush

@section('content')

{{-- =====================================================
     CONTACT PAGE - SECTION 01
     PREMIUM HERO BANNER
===================================================== --}}

<section
    class="sa-contact-hero"
    aria-labelledby="sa-contact-hero-title"
>

    {{-- Background Image --}}
    <div class="sa-contact-hero-image" aria-hidden="true">
        <img
            src="{{ asset('images/contact/contact-hero.jpg') }}"
            alt=""
            fetchpriority="high"
        >
    </div>

    {{-- Dark Overlay --}}
    <div
        class="sa-contact-hero-overlay"
        aria-hidden="true"
    ></div>

    {{-- Hero Content --}}
    <div class="sa-contact-hero-container">

        <div class="sa-contact-hero-content">

            <span class="sa-contact-hero-eyebrow">
                WE'D LOVE TO HEAR FROM YOU
            </span>

            <h1 id="sa-contact-hero-title">
                Get in <em>Touch</em>
            </h1>

            <p>
                Have a question or a décor idea in mind?
                Let's create something beautiful together.
            </p>

            {{-- Breadcrumb --}}
            <nav
                class="sa-contact-breadcrumb"
                aria-label="Breadcrumb"
            >
                <a href="{{ route('home') }}">
                    Home
                </a>

                <span
                    class="sa-contact-breadcrumb-divider"
                    aria-hidden="true"
                >
                    /
                </span>

                <span aria-current="page">
                    Contact Us
                </span>
            </nav>

        </div>

    </div>

</section>


{{-- =====================================================
     CONTACT PAGE - SECTION 02
     CONTACT INFORMATION & ENQUIRY FORM
===================================================== --}}

<section class="sa-contact-main" id="contact-enquiry">

    <div class="sa-contact-main-container">

        {{-- LEFT: CONTACT INFORMATION --}}
        <div class="sa-contact-info">

            <span class="sa-contact-section-eyebrow">
                GET IN TOUCH
            </span>

            <h2>
                Let's Talk About
                <em>Your Space</em>
            </h2>

            <p class="sa-contact-info-intro">
                Have a décor idea, product enquiry or a space
                you'd love to transform? Reach out to us and
                let's explore the possibilities together.
            </p>

            <div class="sa-contact-info-list">

                {{-- Phone --}}
                <div class="sa-contact-info-item">

                    <div class="sa-contact-info-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.6"
                             aria-hidden="true">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                                     19.79 19.79 0 0 1-8.63-3.07
                                     19.5 19.5 0 0 1-6-6
                                     19.79 19.79 0 0 1-3.07-8.67
                                     A2 2 0 0 1 4.11 2h3
                                     a2 2 0 0 1 2 1.72
                                     c.12.96.35 1.9.68 2.81
                                     a2 2 0 0 1-.45 2.11L8.09 9.91
                                     a16 16 0 0 0 6 6l1.27-1.25
                                     a2 2 0 0 1 2.11-.45
                                     c.91.33 1.85.56 2.81.68
                                     A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Call Us</h3>
                        <a href="tel:+919311036306">
                            +91 9311036306
                        </a>
                    </div>

                </div>

                {{-- Email --}}
                <div class="sa-contact-info-item">

                    <div class="sa-contact-info-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.6"
                             aria-hidden="true">
                            <rect x="2" y="4" width="20"
                                  height="16" rx="2"/>
                            <path d="m22 7-10 7L2 7"/>
                        </svg>
                    </div>

                    <div>
                        <h3>Email Us</h3>
                        <a href="mailto:softallure.decor@gmail.com">
                            softallure.decor@gmail.com
                        </a>
                    </div>

                </div>

                {{-- WhatsApp --}}
                <div class="sa-contact-info-item">

                    <div class="sa-contact-info-icon">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.6"
                             aria-hidden="true">
                            <path d="M21 11.5a8.5 8.5 0 0 1-12.4
                                     7.55L3 21l1.95-5.6A8.5 8.5
                                     0 1 1 21 11.5z"/>
                            <path d="M9 8.5c.5 3 2.5 5 6 6.5"/>
                        </svg>
                    </div>

                    <div>
                        <h3>WhatsApp</h3>
                        <a
                            href="https://wa.me/919311036306?text=Hello%20Soft%20Allure%20Decor%2C%20I%20would%20like%20to%20enquire%20about%20your%20products."
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            Chat With Us →
                        </a>
                    </div>

                </div>

            </div>

            <div class="sa-contact-info-note">
                <span class="sa-contact-note-line"></span>
                <p>
                    Thoughtful décor begins with a conversation.
                </p>
            </div>

        </div>

        {{-- RIGHT: ENQUIRY FORM --}}
        <div class="sa-contact-form-card">

            <span class="sa-contact-form-eyebrow">
                SEND AN ENQUIRY
            </span>

            <h2>How Can We Help?</h2>

            <p class="sa-contact-form-intro">
                Fill out the form and we'll get back to you.
            </p>

            {{-- Success Message --}}
            @if(session('contact_success'))
                <div class="sa-contact-alert sa-contact-alert-success"
                     role="status">
                    {{ session('contact_success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if($errors->any())
                <div class="sa-contact-alert sa-contact-alert-error"
                     role="alert">
                    Please correct the highlighted fields.
                </div>
            @endif

            <form
                action="{{ route('contact.submit') }}"
                method="POST"
                class="sa-contact-form"
                id="sa-contact-form"
            >
                @csrf

                {{-- Honeypot --}}
                <div class="sa-contact-honeypot"
                     aria-hidden="true">
                    <label for="company_website">
                        Company Website
                    </label>
                    <input
                        type="text"
                        name="company_website"
                        id="company_website"
                        tabindex="-1"
                        autocomplete="off"
                    >
                </div>

                <div class="sa-contact-form-row">

                    <div class="sa-contact-field">
                        <label for="contact_name">
                            Full Name <span>*</span>
                        </label>
                        <input
                            type="text"
                            id="contact_name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Your full name"
                            autocomplete="name"
                            maxlength="100"
                            required
                            aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                        >
                        @error('name')
                            <small class="sa-contact-field-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="sa-contact-field">
                        <label for="contact_email">
                            Email Address <span>*</span>
                        </label>
                        <input
                            type="email"
                            id="contact_email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            autocomplete="email"
                            maxlength="150"
                            required
                            aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                        >
                        @error('email')
                            <small class="sa-contact-field-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                </div>

                <div class="sa-contact-form-row">

                    <div class="sa-contact-field">
                        <label for="contact_phone">
                            Phone Number
                        </label>
                        <input
                            type="tel"
                            id="contact_phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+91 XXXXX XXXXX"
                            autocomplete="tel"
                            maxlength="20"
                            aria-invalid="{{ $errors->has('phone') ? 'true' : 'false' }}"
                        >
                        @error('phone')
                            <small class="sa-contact-field-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="sa-contact-field">
                        <label for="contact_subject">
                            Enquiry Type <span>*</span>
                        </label>
                        <select
                            id="contact_subject"
                            name="subject"
                            required
                            aria-invalid="{{ $errors->has('subject') ? 'true' : 'false' }}"
                        >
                            <option value="">
                                Select enquiry type
                            </option>

                            @foreach([
                                'Product Enquiry',
                                'Interior Décor Consultation',
                                'Custom Décor',
                                'Project Collaboration',
                                'General Enquiry'
                            ] as $option)
                                <option
                                    value="{{ $option }}"
                                    @selected(old('subject') === $option)
                                >
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>

                        @error('subject')
                            <small class="sa-contact-field-error">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                </div>

                <div class="sa-contact-field">
                    <label for="contact_message">
                        Your Message <span>*</span>
                    </label>

                    <textarea
                        id="contact_message"
                        name="message"
                        rows="5"
                        maxlength="3000"
                        placeholder="Tell us about your requirements..."
                        required
                        aria-invalid="{{ $errors->has('message') ? 'true' : 'false' }}"
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <small class="sa-contact-field-error">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="sa-contact-submit"
                    id="sa-contact-submit"
                >
                    <span class="sa-contact-submit-text">
                        Send Message
                    </span>

                    <span aria-hidden="true">→</span>
                </button>

                <p class="sa-contact-form-disclaimer">
                    Your details will only be used to respond
                    to your enquiry.
                </p>

            </form>

        </div>

    </div>

</section>


{{-- =====================================================
     CONTACT PAGE - SECTION 03
     BUSINESS LOCATION & MAP
===================================================== --}}

<section
    class="sa-contact-location"
    id="contact-location"
    aria-labelledby="sa-contact-location-title"
>
    <div class="sa-contact-location-container">

        {{-- LEFT: LOCATION INFORMATION --}}
        <div class="sa-contact-location-content">

            <span class="sa-contact-location-eyebrow">
                FIND US
            </span>

            <h2 id="sa-contact-location-title">
                Let's Connect
                <em>Beyond the Screen</em>
            </h2>

            <p class="sa-contact-location-description">
                We'd love to help you explore beautiful décor
                possibilities. Connect with our team for
                enquiries, product information and assistance.
            </p>

            <div class="sa-contact-location-details">

                <div class="sa-contact-location-detail">
                    <span class="sa-contact-location-icon"
                          aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.6">
                            <path d="M20 10c0 5-8 12-8 12S4 15 4 10
                                     a8 8 0 1 1 16 0Z"/>
                            <circle cx="12" cy="10" r="2.5"/>
                        </svg>
                    </span>

                    <div>
                        <h3>Our Location</h3>
                        <p>
                            Location details coming soon
                        </p>
                    </div>
                </div>

                <div class="sa-contact-location-detail">
                    <span class="sa-contact-location-icon"
                          aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.6">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                                     19.79 19.79 0 0 1-8.63-3.07
                                     19.5 19.5 0 0 1-6-6
                                     19.79 19.79 0 0 1-3.07-8.67
                                     A2 2 0 0 1 4.11 2h3
                                     a2 2 0 0 1 2 1.72
                                     c.12.96.35 1.9.68 2.81
                                     a2 2 0 0 1-.45 2.11L8.09 9.91
                                     a16 16 0 0 0 6 6l1.27-1.25
                                     a2 2 0 0 1 2.11-.45
                                     c.91.33 1.85.56 2.81.68
                                     A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </span>

                    <div>
                        <h3>Need Assistance?</h3>
                        <a href="tel:+919311036306">
                            +91 9311036306
                        </a>
                    </div>
                </div>

            </div>

            <a
                href="mailto:softallure.decor@gmail.com"
                class="sa-contact-location-btn"
            >
                Email Our Team
                <span aria-hidden="true">→</span>
            </a>

        </div>

        {{-- RIGHT: MAP PLACEHOLDER --}}
        <div class="sa-contact-map">

            <div class="sa-contact-map-placeholder">

                <div class="sa-contact-map-symbol"
                     aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none"
                         stroke="currentColor"
                         stroke-width="1.4">
                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10
                                 a8 8 0 1 1 16 0Z"/>
                        <circle cx="12" cy="10" r="2.5"/>
                    </svg>
                </div>

                <h3>Our Location</h3>

                <p>
                    Map and directions will be available soon.
                </p>

            </div>

        </div>

    </div>
</section>


{{-- =====================================================
     CONTACT PAGE - SECTION 04
     FINAL PREMIUM CONTACT CTA
===================================================== --}}

<section
    class="sa-contact-final-cta"
    id="contact-final-cta"
    aria-labelledby="sa-contact-final-title"
>

    <div class="sa-contact-final-container">

        <div class="sa-contact-final-content">

            <span class="sa-contact-final-eyebrow">
                YOUR SPACE, OUR PASSION
            </span>

            <h2 id="sa-contact-final-title">
                Let's Bring Your
                <em>Vision to Life</em>
            </h2>

            <p>
                Beautiful spaces begin with thoughtful conversations.
                Connect with us to explore elegant décor solutions
                for your home or business.
            </p>

            <div class="sa-contact-final-actions">

                {{-- Call Button --}}
                <a
                    href="tel:+919311036306"
                    class="sa-contact-final-btn sa-contact-final-btn-primary"
                    aria-label="Call Soft Allure Décor"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.7"
                        aria-hidden="true"
                    >
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2
                                 19.79 19.79 0 0 1-8.63-3.07
                                 19.5 19.5 0 0 1-6-6
                                 19.79 19.79 0 0 1-3.07-8.67
                                 A2 2 0 0 1 4.11 2h3
                                 a2 2 0 0 1 2 1.72
                                 c.12.96.35 1.9.68 2.81
                                 a2 2 0 0 1-.45 2.11L8.09 9.91
                                 a16 16 0 0 0 6 6l1.27-1.25
                                 a2 2 0 0 1 2.11-.45
                                 c.91.33 1.85.56 2.81.68
                                 A2 2 0 0 1 22 16.92z"/>
                    </svg>

                    <span>Call Now</span>
                </a>

                {{-- WhatsApp Button --}}
                <a
                    href="https://wa.me/919311036306?text=Hello%20Soft%20Allure%20Decor%2C%20I%20would%20like%20to%20discuss%20my%20decor%20requirements."
                    class="sa-contact-final-btn sa-contact-final-btn-outline"
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
                        <path d="M21 11.5a8.5 8.5 0 0 1-12.4
                                 7.55L3 21l1.95-5.6A8.5 8.5
                                 0 1 1 21 11.5z"/>
                        <path d="M9 8.5c.5 3 2.5 5 6 6.5"/>
                    </svg>

                    <span>WhatsApp Us</span>
                </a>

            </div>

        </div>

    </div>

</section>

@endsection

@push('scripts')
<script src="{{ asset('js/contact.js') }}" defer></script>
@endpush
