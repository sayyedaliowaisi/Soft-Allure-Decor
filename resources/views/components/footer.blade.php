<footer class="bg-gray-950 text-white">

    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- Brand -->
            <div class="lg:col-span-1">

                <a href="{{ route('home') }}" class="inline-block">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Soft Allure Décor"
                        class="h-14 w-auto">
                </a>

                <p class="mt-6 text-gray-400 leading-7">
                    Premium home décor solutions designed to bring
                    elegance, comfort, and character to modern spaces.
                </p>

                <!-- Social -->
                <div class="mt-7 flex gap-3">

                    <a href="#"
                       class="w-10 h-10 rounded-full bg-white/5
                              border border-white/10
                              flex items-center justify-center
                              hover:bg-yellow-500
                              hover:text-black
                              transition">
                        f
                    </a>

                    <a href="#"
                       class="w-10 h-10 rounded-full bg-white/5
                              border border-white/10
                              flex items-center justify-center
                              hover:bg-yellow-500
                              hover:text-black
                              transition">
                        ◎
                    </a>

                    <a href="#"
                       class="w-10 h-10 rounded-full bg-white/5
                              border border-white/10
                              flex items-center justify-center
                              hover:bg-yellow-500
                              hover:text-black
                              transition">
                        in
                    </a>

                </div>

            </div>


            <!-- Quick Links -->
            <div>

                <h3 class="text-lg font-bold">
                    Quick Links
                </h3>

                <ul class="mt-6 space-y-4">

                    <li>
                        <a href="{{ route('home') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('about') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Products
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('gallery') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Gallery
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Products -->
            <div>

                <h3 class="text-lg font-bold">
                    Our Products
                </h3>

                <ul class="mt-6 space-y-4">

                    <li>
                        <a href="{{ route('products') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Decorative Wall Panels
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Decorative Cushions
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Custom Décor
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('products') }}"
                           class="text-gray-400 hover:text-yellow-400 transition">
                            Bulk / Wholesale
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Contact -->
            <div>

                <h3 class="text-lg font-bold">
                    Get In Touch
                </h3>

                <div class="mt-6 space-y-5">

                    <div class="flex gap-4">

                        <div class="text-yellow-400">
                            @
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Email
                            </p>

                            <a href="mailto:info@example.com"
                               class="text-gray-300 hover:text-yellow-400 transition">
                                info@example.com
                            </a>

                        </div>

                    </div>


                    <div class="flex gap-4">

                        <div class="text-yellow-400">
                            ☎
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Phone
                            </p>

                            <a href="tel:+910000000000"
                               class="text-gray-300 hover:text-yellow-400 transition">
                                +91 00000 00000
                            </a>

                        </div>

                    </div>


                    <div class="flex gap-4">

                        <div class="text-yellow-400">
                            ⌖
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Location
                            </p>

                            <p class="text-gray-300">
                                India
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Bottom Bar -->
    <div class="border-t border-white/10">

        <div class="max-w-7xl mx-auto px-6 lg:px-8
                    py-6
                    flex flex-col md:flex-row
                    items-center justify-between
                    gap-4">

            <p class="text-sm text-gray-500 text-center md:text-left">
                © {{ date('Y') }} Soft Allure Décor. All rights reserved.
            </p>

            <div class="flex gap-6 text-sm">

                <a href="#"
                   class="text-gray-500 hover:text-yellow-400 transition">
                    Privacy Policy
                </a>

                <a href="#"
                   class="text-gray-500 hover:text-yellow-400 transition">
                    Terms & Conditions
                </a>

            </div>

        </div>

    </div>

</footer>