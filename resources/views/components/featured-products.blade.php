<!-- @props(['products'])

<section class="py-24 bg-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-14">

            <span class="text-amber-500 uppercase tracking-[4px] font-semibold">
                Featured Products
            </span>

            <h2 class="mt-4 text-4xl lg:text-5xl font-bold">
                Our Best Sellers
            </h2>

        </div>

        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            @forelse($products as $product)

                <div class="group rounded-3xl overflow-hidden bg-white shadow-lg hover:shadow-2xl transition duration-500">

                    <div class="overflow-hidden">

                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            class="h-72 w-full object-cover group-hover:scale-110 transition duration-700"
                            alt="{{ $product->name }}">

                    </div>

                    <div class="p-6">

                        <span class="text-sm text-amber-500">
                            {{ $product->category }}
                        </span>

                        <h3 class="mt-2 text-2xl font-semibold">
                            {{ $product->name }}
                        </h3>

                        <p class="mt-3 text-gray-600">
                            {{ $product->short_description }}
                        </p>

                        @if($product->price)

                            <div class="mt-4 text-xl font-bold">
                                ₹ {{ number_format($product->price,2) }}
                            </div>

                        @endif

                        <a
                            href="#"
                            class="mt-6 inline-flex rounded-full bg-gray-900 px-6 py-3 text-white hover:bg-amber-500 hover:text-black transition">

                            View Details

                        </a>

                    </div>

                </div>

            @empty

                <div class="col-span-full text-center text-gray-500">

                    Products Coming Soon

                </div>

            @endforelse

        </div>

    </div>

</section> -->



<section class="relative py-24 lg:py-32 bg-gray-50 overflow-hidden">

    <!-- Background Decoration -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-60"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-yellow-100 rounded-full blur-3xl opacity-50"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Section Heading -->
        <div class="text-center max-w-3xl mx-auto">

            <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                OUR COLLECTION
            </span>

            <h2 class="mt-6 text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 leading-tight">
                Designed to Make
                <span class="text-yellow-500">Every Space Beautiful</span>
            </h2>

            <p class="mt-6 text-lg text-gray-600 leading-8">
                Explore our range of premium décor solutions created for
                modern homes, offices, hospitality spaces, and interior projects.
            </p>

        </div>


        <!-- Product Cards -->
        <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Card 1 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 border border-gray-100">

                <div class="h-64 bg-gradient-to-br from-gray-900 via-gray-700 to-yellow-700 flex items-center justify-center relative overflow-hidden">

                    <div class="absolute inset-0 bg-black/10"></div>

                    <div class="relative text-center text-white">

                        <div class="text-6xl mb-4">
                            ▦
                        </div>

                        <span class="text-sm uppercase tracking-[0.25em] text-yellow-300">
                            Collection 01
                        </span>

                    </div>

                    <div class="absolute inset-0 bg-yellow-400/0 group-hover:bg-yellow-400/10 transition duration-500"></div>

                </div>

                <div class="p-7">

                    <span class="text-sm font-semibold text-yellow-600">
                        PREMIUM COLLECTION
                    </span>

                    <h3 class="mt-2 text-2xl font-bold text-gray-900">
                        Decorative Wall Panels
                    </h3>

                    <p class="mt-3 text-gray-600 leading-7">
                        Elegant wall solutions designed to add depth,
                        character, and sophistication to interiors.
                    </p>

                    <a href="{{ route('products') }}"
                       class="inline-flex items-center gap-2 mt-6 font-semibold text-gray-900 hover:text-yellow-600 transition">

                        Explore Collection
                        <span class="group-hover:translate-x-1 transition">→</span>

                    </a>

                </div>

            </div>


            <!-- Card 2 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 border border-gray-100">

                <div class="h-64 bg-gradient-to-br from-yellow-100 via-yellow-300 to-yellow-600 flex items-center justify-center relative overflow-hidden">

                    <div class="relative text-center text-gray-900">

                        <div class="text-6xl mb-4">
                            ◈
                        </div>

                        <span class="text-sm uppercase tracking-[0.25em]">
                            Collection 02
                        </span>

                    </div>

                    <div class="absolute inset-0 bg-white/0 group-hover:bg-white/20 transition duration-500"></div>

                </div>

                <div class="p-7">

                    <span class="text-sm font-semibold text-yellow-600">
                        LUXURY COMFORT
                    </span>

                    <h3 class="mt-2 text-2xl font-bold text-gray-900">
                        Decorative Cushions
                    </h3>

                    <p class="mt-3 text-gray-600 leading-7">
                        Sophisticated decorative cushions created to
                        complement contemporary interior environments.
                    </p>

                    <a href="{{ route('products') }}"
                       class="inline-flex items-center gap-2 mt-6 font-semibold text-gray-900 hover:text-yellow-600 transition">

                        Explore Collection
                        <span class="group-hover:translate-x-1 transition">→</span>

                    </a>

                </div>

            </div>


            <!-- Card 3 -->
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 border border-gray-100">

                <div class="h-64 bg-gradient-to-br from-gray-200 via-gray-400 to-gray-700 flex items-center justify-center relative overflow-hidden">

                    <div class="relative text-center text-white">

                        <div class="text-6xl mb-4">
                            ✦
                        </div>

                        <span class="text-sm uppercase tracking-[0.25em]">
                            Collection 03
                        </span>

                    </div>

                    <div class="absolute inset-0 bg-yellow-400/0 group-hover:bg-yellow-400/10 transition duration-500"></div>

                </div>

                <div class="p-7">

                    <span class="text-sm font-semibold text-yellow-600">
                        BESPOKE SOLUTIONS
                    </span>

                    <h3 class="mt-2 text-2xl font-bold text-gray-900">
                        Custom Décor Solutions
                    </h3>

                    <p class="mt-3 text-gray-600 leading-7">
                        Tailored décor solutions created around your
                        design requirements and project specifications.
                    </p>

                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 mt-6 font-semibold text-gray-900 hover:text-yellow-600 transition">

                        Discuss Your Project
                        <span class="group-hover:translate-x-1 transition">→</span>

                    </a>

                </div>

            </div>

        </div>


        <!-- Bottom CTA -->
        <div class="mt-14 text-center">

            <a href="{{ route('products') }}"
               class="inline-flex items-center gap-3 px-8 py-4 rounded-full bg-gray-900 text-white font-semibold hover:bg-yellow-500 hover:text-black transition duration-300">

                View All Products

                <span>→</span>

            </a>

        </div>

    </div>

</section>