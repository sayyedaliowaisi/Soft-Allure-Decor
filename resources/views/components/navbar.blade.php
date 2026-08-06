<header
    x-data="{
        mobileMenu:false,
        scrolled:false
    }"
    x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 40
        });

        $watch('mobileMenu', value => {
            document.body.classList.toggle('overflow-hidden', value)
        });
    "
    class="fixed top-0 inset-x-0 z-50"
>

    <!-- Top Bar -->
    <div
        x-show="!scrolled"
        x-transition
        class="hidden lg:block bg-black text-white"
    >

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center py-2 text-sm">

                <p>Premium Home Décor & Furnishings</p>

                <div class="flex gap-6">

                    <a href="tel:+919311036306">
                        +91 9311036306
                    </a>

                    <a href="mailto:softallure.decor@gmail.com">
                        softallure.decor@gmail.com
                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Navbar -->

    <nav
        :class="scrolled
            ? 'bg-white shadow-xl'
            : 'bg-black/80 backdrop-blur-md'"
        class="transition-all duration-500"
    >

        <div class="max-w-7xl mx-auto">

            <div class="flex items-center justify-between h-16 lg:h-20 px-4 lg:px-8">

                <!-- Logo -->

                <a href="/">

                    <img
    src="{{ asset('images/logo.png') }}"
    alt="Soft Allure"
    class="h-10 lg:h-12 w-auto object-contain transition-all duration-500"
    :class="scrolled ? 'lg:h-10' : 'lg:h-12'"
>

                </a>

                <!-- Desktop -->

                <div class="hidden lg:flex items-center gap-10">

                    <a href="#" class="menu-link" :class="scrolled ? 'text-black' : 'text-white'">Home</a>

                    <a href="#about" class="menu-link" :class="scrolled ? 'text-black' : 'text-white'">About</a>

                    <a href="#products" class="menu-link" :class="scrolled ? 'text-black' : 'text-white'">Products</a>

                    <a href="#gallery" class="menu-link" :class="scrolled ? 'text-black' : 'text-white'">Gallery</a>

                    <a href="#contact" class="menu-link" :class="scrolled ? 'text-black' : 'text-white'">Contact</a>

                </div>

                <!-- Right -->

                <div class="hidden lg:flex items-center gap-4">

                    <button
                        :class="scrolled ? 'text-black':'text-white'"
                    >
                        🔍
                    </button>

                    <a
                        href="#contact"
                        class="rounded-full bg-amber-500 px-6 py-3 text-white hover:bg-amber-600 transition"
                    >
                        Get Quote
                    </a>

                </div>

                <!-- Mobile Button -->

                <button
                    @click="mobileMenu = true"
                    class="lg:hidden"
                    :class="scrolled ? 'text-black':'text-white'"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </nav>

    <!-- Overlay -->

    <div
        x-show="mobileMenu"
        x-transition.opacity
        x-cloak
        @click="mobileMenu = false"
        class="fixed inset-0 z-40 bg-black/60 lg:hidden"
    ></div>

    <!-- Drawer -->

    <aside

        x-show="mobileMenu"

        x-cloak

        @keydown.escape.window="mobileMenu = false"

        x-transition:enter="transform transition ease-out duration-300"

        x-transition:enter-start="translate-x-full"

        x-transition:enter-end="translate-x-0"

        x-transition:leave="transform transition ease-in duration-300"

        x-transition:leave-start="translate-x-0"

        x-transition:leave-end="translate-x-full"

        class="fixed top-0 right-0 z-50 h-screen w-80 bg-white shadow-2xl lg:hidden"

    >

        <div class="flex items-center justify-between border-b p-5">

            <img
                src="{{ asset('images/logo.png') }}"
                class="h-12"
            >

            <button
                @click="mobileMenu = false"
                class="rounded-md p-2 hover:bg-gray-100"
            >

                ✕

            </button>

        </div>

        <div class="flex flex-col p-6 space-y-6">

            <a href="#">Home</a>

            <a href="#about">About</a>

            <a href="#products">Products</a>

            <a href="#gallery">Gallery</a>

            <a href="#contact">Contact</a>

            <hr>

            <a href="tel:+919311036306">

                📞 +91 9311036306

            </a>

            <a href="mailto:softallure.decor@gmail.com">

                ✉ softallure.decor@gmail.com

            </a>

            <a
                href="#contact"
                class="rounded-full bg-amber-500 py-3 text-center font-semibold text-white"
            >

                Get Quote

            </a>

        </div>

    </aside>

</header>