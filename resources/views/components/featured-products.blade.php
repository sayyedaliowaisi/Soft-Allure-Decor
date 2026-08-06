@props(['products'])

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

</section>