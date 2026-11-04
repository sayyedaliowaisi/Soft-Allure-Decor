
{{-- ============================================
     SOFT ALLURE DÉCOR - PREMIUM FOOTER
============================================ --}}

<footer class="sa-footer" id="footer">

    <div class="sa-footer-container">

        {{-- MAIN FOOTER --}}
        <div class="sa-footer-top">

            {{-- BRAND --}}
            <div class="sa-footer-brand-wrap">

                <a href="{{ route('home') }}"
                   class="sa-footer-brand"
                   aria-label="Soft Allure Décor Home">

                    {{-- Golden House Logo --}}
                    <span class="sa-footer-house">
                        <svg viewBox="0 0 64 64"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2.2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">

                            <path d="M5 28 32 5l27 23"/>
                            <path d="M12 24v34h40V24"/>
                            <path d="M24 58V38h16v20"/>
                            <path d="M5 38 32 15l27 23"/>

                        </svg>
                    </span>

                    <span class="sa-footer-brand-text">

                        <span class="sa-footer-logo">
                            Soft Allure
                        </span>

                        <span class="sa-footer-logo-sub">
                            <span></span>
                            DÉCOR
                            <span></span>
                        </span>

                    </span>

                </a>

                <p class="sa-footer-tagline">
                    Elegant in Every Detail
                </p>

            </div>

            {{-- FOOTER NAVIGATION --}}
            <nav class="sa-footer-nav"
                 aria-label="Footer navigation">

                <a href="{{ route('home') }}">
                    Home
                </a>

                <a href="{{ route('products') }}">
                    Products
                </a>

                <a href="{{ route('gallery') }}">
                    Gallery
                </a>

                <a href="{{ route('about') }}">
                    About Us
                </a>

                <a href="{{ route('home') }}#testimonials">
                    Testimonials
                </a>

                <a href="{{ route('contact') }}">
                    Contact
                </a>

            </nav>

            {{-- SOCIAL MEDIA --}}
            <div class="sa-footer-social-wrap">

                <span class="sa-footer-follow">
                    Follow Us
                </span>

                <div class="sa-footer-social">

                    {{-- Facebook --}}
                    <span class="sa-footer-social-icon"
                          title="Facebook"
                          aria-label="Facebook">

                        <svg viewBox="0 0 24 24"
                             fill="currentColor"
                             aria-hidden="true">
                            <path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.77l-.44 2.89h-2.33v6.99A10 10 0 0 0 22 12Z"/>
                        </svg>

                    </span>

                    {{-- Instagram --}}
                    <span class="sa-footer-social-icon"
                          title="Instagram"
                          aria-label="Instagram">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             aria-hidden="true">

                            <rect x="3" y="3"
                                  width="18"
                                  height="18"
                                  rx="5"/>

                            <circle cx="12"
                                    cy="12"
                                    r="4"/>

                            <circle cx="17.5"
                                    cy="6.5"
                                    r="1"
                                    fill="currentColor"
                                    stroke="none"/>

                        </svg>

                    </span>

                    {{-- LinkedIn --}}
                    <span class="sa-footer-social-icon"
                          title="LinkedIn"
                          aria-label="LinkedIn">

                        <svg viewBox="0 0 24 24"
                             fill="currentColor"
                             aria-hidden="true">

                            <path d="M5.2 3a2.2 2.2 0 1 0 0 4.4 2.2 2.2 0 0 0 0-4.4ZM3.5 9h3.4v12H3.5V9ZM9 9h3.3v1.6h.05c.46-.87 1.59-1.8 3.27-1.8 3.5 0 4.15 2.3 4.15 5.3V21h-3.44v-6.1c0-1.45-.03-3.3-2.02-3.3-2.02 0-2.33 1.57-2.33 3.2V21H9V9Z"/>

                        </svg>

                    </span>

                    {{-- Pinterest --}}
                    <span class="sa-footer-social-icon"
                          title="Pinterest"
                          aria-label="Pinterest">

                        <svg viewBox="0 0 24 24"
                             fill="currentColor"
                             aria-hidden="true">

                            <path d="M12 2a10 10 0 0 0-3.64 19.32c-.03-.79-.01-1.74.2-2.59l1.3-5.49s-.32-.65-.32-1.61c0-1.51.87-2.64 1.96-2.64.93 0 1.38.7 1.38 1.54 0 .94-.6 2.34-.91 3.64-.26 1.09.55 1.98 1.62 1.98 1.95 0 3.45-2.06 3.45-5.04 0-2.63-1.89-4.47-4.59-4.47-3.13 0-4.96 2.34-4.96 4.76 0 .94.36 1.94.81 2.49.09.11.1.21.08.32l-.3 1.23c-.05.2-.16.24-.37.15-1.37-.64-2.23-2.64-2.23-4.25 0-3.46 2.51-6.64 7.24-6.64 3.8 0 6.75 2.71 6.75 6.33 0 3.78-2.38 6.82-5.68 6.82-1.11 0-2.16-.58-2.52-1.26l-.69 2.62c-.25.97-.92 2.18-1.37 3.01A10 10 0 1 0 12 2Z"/>

                        </svg>

                    </span>

                </div>

            </div>

        </div>

        {{-- BOTTOM FOOTER --}}
        <div class="sa-footer-bottom">

            <p class="sa-footer-copyright">
                &copy; {{ date('Y') }} Soft Allure Décor.
                All rights reserved.
            </p>

            <div class="sa-footer-legal">

                <a href="{{ url('/privacy-policy') }}">
                    Privacy Policy
                </a>

                <span class="sa-footer-divider">|</span>

                <a href="{{ url('/terms-and-conditions') }}">
                    Terms &amp; Conditions
                </a>

            </div>

        </div>

    </div>

</footer>
