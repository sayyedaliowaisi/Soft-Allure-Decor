<section id="products" class="py-24 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4">

        <div class="text-center">

            <span class="text-amber-500 font-semibold uppercase tracking-[4px]">

                Our Collections

            </span>

            <h2 class="mt-4 text-4xl lg:text-5xl font-bold">

                Premium Home Décor Categories

            </h2>

            <p class="mt-6 text-gray-500 max-w-2xl mx-auto">

                Explore our exclusive collection of luxury décor and
                furnishing products crafted to transform every space.

            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">

            @php

            $categories=[

            ['Wallpaper','wallpaper.jpg'],

            ['Curtains','curtain.jpg'],

            ['Designer Cushions','cushion.jpg'],

            ['Furniture','furniture.jpg'],

            ['Leather','leather.jpg'],

            ['Wall Panels','wallpanel.jpg']

            ];

            @endphp

            @foreach($categories as $item)

            <div
                class="group overflow-hidden rounded-3xl shadow-lg bg-white">

                <div class="relative overflow-hidden">

                    <img
                        src="{{ asset('images/categories/'.$item[1]) }}"
                        class="h-80 w-full object-cover transition duration-700 group-hover:scale-110">

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                    </div>

                    <div
                        class="absolute bottom-8 left-8">

                        <h3
                            class="text-2xl font-bold text-white">

                            {{ $item[0] }}

                        </h3>

                        <a
                            href="#"
                            class="mt-3 inline-flex items-center gap-2 text-amber-400">

                            View Collection →

                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>