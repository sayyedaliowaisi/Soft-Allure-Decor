<header
    x-data="{
        mobileMenu: false,
        scrolled: false
    }"

    x-init="
        const handleScroll = () => {
            scrolled = window.scrollY > 40;
        };

        handleScroll();

        window.addEventListener('scroll', handleScroll);

        $watch('mobileMenu', value => {
            document.body.classList.toggle('overflow-hidden', value);
        });
    "

    @keydown.escape.window="mobileMenu = false"

    class="fixed inset-x-0 top-0 z-[100]"
>

    {{-- =========================================================
         TOP INFORMATION BAR
    ========================================================== --}}

    <div
        x-show="!scrolled"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="hidden lg:block bg-black text-white"
    >

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="flex min-h-[40px] items-center justify-between text-sm">

                <p class="tracking-wide">
                    Premium Home Décor & Furnishings
                </p>

                <div class="flex items-center gap-7">

                    <a
                        href="tel:+919311036306"
                        class="transition hover:text-amber-400"
                    >
                        +91 9311036306
                    </a>

                    <a
                        href="mailto:softallure.decor@gmail.com"
                        class="transition hover:text-amber-400"
                    >
                        softallure.decor@gmail.com
                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MAIN NAVBAR
    ========================================================== --}}

    <nav
        :class="scrolled
            ? 'bg-white shadow-lg'
            : 'bg-black/80 backdrop-blur-md'"
        class="transition-all duration-500"
    >

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex h-16 items-center justify-between lg:h-20">

                {{-- =================================================
                     LOGO
                ================================================== --}}

                <a
                    href="{{ route('home') }}"
                    class="shrink-0"
                >

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Soft Allure Décor"
                        class="h-10 w-auto object-contain transition-all duration-500 lg:h-12"
                        :class="scrolled ? 'lg:h-10' : 'lg:h-12'"
                    >

                </a>


                {{-- =================================================
                     DESKTOP MENU
                ================================================== --}}

                <div class="hidden items-center gap-9 lg:flex">

                    <a
                        href="{{ route('home') }}"
                        class="menu-link"
                        :class="scrolled ? 'text-black' : 'text-white'"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('about') }}"
                        class="menu-link"
                        :class="scrolled ? 'text-black' : 'text-white'"
                    >
                        About
                    </a>

                    <a
                        href="{{ route('home') }}#products"
                        class="menu-link"
                        :class="scrolled ? 'text-black' : 'text-white'"
                    >
                        Products
                    </a>

                    <a
                        href="{{ route('gallery') }}"
                        class="menu-link"
                        :class="scrolled ? 'text-black' : 'text-white'"
                    >
                        Gallery
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="menu-link"
                        :class="scrolled ? 'text-black' : 'text-white'"
                    >
                        Contact
                    </a>

                </div>


                {{-- =================================================
                     DESKTOP RIGHT
                ================================================== --}}

                <div class="hidden items-center gap-5 lg:flex">

                    {{-- Search --}}
                    <button
                        type="button"
                        aria-label="Search"
                        :class="scrolled
                            ? 'text-black hover:bg-gray-100'
                            : 'text-white hover:bg-white/10'"
                        class="rounded-full p-2.5 transition"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                            />

                        </svg>

                    </button>


                    {{-- Get Quote --}}
                    <a
                        href="{{ route('contact') }}"
                        class="rounded-full bg-amber-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-amber-600 hover:shadow-lg"
                    >
                        Get Quote
                    </a>

                </div>


                {{-- =================================================
                     MOBILE MENU BUTTON
                ================================================== --}}

                <button
                    type="button"
                    @click="mobileMenu = true"
                    aria-label="Open menu"
                    :aria-expanded="mobileMenu"
                    :class="scrolled
                        ? 'text-black hover:bg-gray-100'
                        : 'text-white hover:bg-white/10'"
                    class="rounded-lg p-2 transition lg:hidden"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </nav>


    {{-- =========================================================
         MOBILE OVERLAY
    ========================================================== --}}

    <div
        x-show="mobileMenu"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileMenu = false"
        class="fixed inset-0 z-[110] bg-black/60 backdrop-blur-sm lg:hidden"
    ></div>


    {{-- =========================================================
         MOBILE DRAWER
    ========================================================== --}}

    <aside
        x-show="mobileMenu"
        x-cloak

        x-transition:enter="transform transition ease-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"

        x-transition:leave="transform transition ease-in duration-250"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"

        class="fixed right-0 top-0 z-[120] flex h-screen w-[min(86vw,360px)] flex-col bg-white shadow-2xl lg:hidden"
    >

        {{-- Drawer Header --}}
        <div class="flex h-20 shrink-0 items-center justify-between border-b border-gray-100 px-5">

            <a
                href="{{ route('home') }}"
                @click="mobileMenu = false"
            >

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Soft Allure Décor"
                    class="h-10 w-auto object-contain"
                >

            </a>


            {{-- Close --}}
            <button
                type="button"
                @click="mobileMenu = false"
                aria-label="Close menu"
                class="rounded-full p-2.5 text-gray-800 transition hover:bg-gray-100"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6l12 12M18 6 6 18"
                    />

                </svg>

            </button>

        </div>


        {{-- Drawer Content --}}
        <div class="flex flex-1 flex-col overflow-y-auto px-6 py-7">

            <nav class="flex flex-col">

                <a
                    href="{{ route('home') }}"
                    @click="mobileMenu = false"
                    class="border-b border-gray-100 py-4 text-lg font-medium text-gray-900 transition hover:text-amber-500"
                >
                    Home
                </a>

                <a
                    href="{{ route('about') }}"
                    @click="mobileMenu = false"
                    class="border-b border-gray-100 py-4 text-lg font-medium text-gray-900 transition hover:text-amber-500"
                >
                    About
                </a>

                <a
                    href="{{ route('home') }}#products"
                    @click="mobileMenu = false"
                    class="border-b border-gray-100 py-4 text-lg font-medium text-gray-900 transition hover:text-amber-500"
                >
                    Products
                </a>

                <a
                    href="{{ route('gallery') }}"
                    @click="mobileMenu = false"
                    class="border-b border-gray-100 py-4 text-lg font-medium text-gray-900 transition hover:text-amber-500"
                >
                    Gallery
                </a>

                <a
                    href="{{ route('contact') }}"
                    @click="mobileMenu = false"
                    class="border-b border-gray-100 py-4 text-lg font-medium text-gray-900 transition hover:text-amber-500"
                >
                    Contact
                </a>

            </nav>


            {{-- Contact Details --}}
            <div class="mt-8 space-y-4">

                <a
                    href="tel:+919311036306"
                    class="flex items-center gap-3 text-sm text-gray-600 transition hover:text-amber-500"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-50 text-amber-500">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.09l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.38 12.035 12.035 0 0 1-7.49-7.49 1.125 1.125 0 0 1 .38-1.21l1.293-.97c.373-.28.54-.762.417-1.173L6.617 2.852A1.125 1.125 0 0 0 5.527 2H4.5A2.25 2.25 0 0 0 2.25 4.25v2.5Z"
                            />
                        </svg>
                    </span>

                    +91 9311036306

                </a>


                <a
                    href="mailto:softallure.decor@gmail.com"
                    class="flex items-center gap-3 text-sm text-gray-600 transition hover:text-amber-500"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-amber-50 text-amber-500">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 7.5 12 13l9-5.5M4.5 19.5h15A1.5 1.5 0 0 0 21 18V6a1.5 1.5 0 0 0-1.5-1.5h-15A1.5 1.5 0 0 0 3 6v12a1.5 1.5 0 0 0 1.5 1.5Z"
                            />
                        </svg>
                    </span>

                    <span class="break-all">
                        softallure.decor@gmail.com
                    </span>

                </a>

            </div>


            {{-- Mobile CTA --}}
            <div class="mt-auto pt-8">

                <a
                    href="{{ route('contact') }}"
                    @click="mobileMenu = false"
                    class="block w-full rounded-full bg-amber-500 px-6 py-4 text-center font-semibold text-white transition hover:bg-amber-600"
                >
                    Get Quote
                </a>

            </div>

        </div>

    </aside>

</header>