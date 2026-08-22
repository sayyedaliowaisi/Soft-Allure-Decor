@extends('layouts.app')

@section('title', 'About Us | Soft Allure Décor')

@section('content')

    {{-- About Hero --}}
    <section class="relative overflow-hidden bg-neutral-950">

        <div class="absolute inset-0">
            <img
                src="{{ asset('images/about-hero.jpg') }}"
                alt="Soft Allure Décor"
                class="h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 mx-auto flex min-h-[55vh] max-w-7xl items-center px-6 py-24 lg:px-8">

            <div class="max-w-3xl text-white">

                <span class="mb-5 inline-block text-sm font-semibold uppercase tracking-[4px] text-amber-400">
                    About Soft Allure
                </span>

                <h1 class="text-4xl font-bold leading-tight sm:text-5xl lg:text-7xl">
                    Creating Beautiful Spaces With
                    <span class="text-amber-400">
                        Timeless Elegance
                    </span>
                </h1>

                <p class="mt-6 max-w-2xl text-base leading-8 text-gray-200 sm:text-lg">
                    We bring together premium décor, thoughtful design and
                    exceptional craftsmanship to transform everyday spaces
                    into elegant and comfortable interiors.
                </p>

            </div>

        </div>

    </section>


    {{-- About Company --}}
    <section class="bg-white py-20 lg:py-28">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid items-center gap-14 lg:grid-cols-2">

                {{-- Image --}}
                <div class="relative">

                    <div class="overflow-hidden rounded-3xl">

                        <img
                            src="{{ asset('images/about-company.jpg') }}"
                            alt="Luxury interior by Soft Allure Décor"
                            class="h-[450px] w-full object-cover transition duration-700 hover:scale-105 sm:h-[550px]"
                        >

                    </div>

                    {{-- Experience Card --}}
                    <div class="absolute -bottom-7 right-5 rounded-2xl bg-amber-500 px-7 py-6 text-white shadow-2xl sm:right-8">

                        <p class="text-4xl font-bold">
                            10+
                        </p>

                        <p class="mt-1 text-sm font-medium">
                            Years of Experience
                        </p>

                    </div>

                </div>


                {{-- Content --}}
                <div>

                    <span class="text-sm font-semibold uppercase tracking-[3px] text-amber-500">
                        Who We Are
                    </span>

                    <h2 class="mt-4 text-3xl font-bold leading-tight text-neutral-900 sm:text-4xl lg:text-5xl">
                        Where Comfort Meets
                        <span class="text-amber-500">
                            Sophisticated Design
                        </span>
                    </h2>

                    <p class="mt-6 leading-8 text-gray-600">
                        At Soft Allure Décor, we believe that a beautiful
                        interior is more than just decoration. It is about
                        creating an environment that reflects personality,
                        comfort and style.
                    </p>

                    <p class="mt-5 leading-8 text-gray-600">
                        Our collection combines contemporary aesthetics with
                        quality materials and careful craftsmanship. From
                        elegant curtains and cushions to wall décor and
                        furnishing solutions, every element is selected to
                        enhance the character of your space.
                    </p>


                    {{-- Features --}}
                    <div class="mt-8 grid gap-5 sm:grid-cols-2">

                        <div class="flex gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                ✓
                            </div>

                            <div>
                                <h3 class="font-semibold text-neutral-900">
                                    Premium Quality
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-gray-500">
                                    Carefully selected materials and finishes.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                ✓
                            </div>

                            <div>
                                <h3 class="font-semibold text-neutral-900">
                                    Custom Solutions
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-gray-500">
                                    Designs tailored to your space and style.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                ✓
                            </div>

                            <div>
                                <h3 class="font-semibold text-neutral-900">
                                    Expert Craftsmanship
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-gray-500">
                                    Attention to detail in every creation.
                                </p>
                            </div>

                        </div>


                        <div class="flex gap-4">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                ✓
                            </div>

                            <div>
                                <h3 class="font-semibold text-neutral-900">
                                    Customer Focused
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-gray-500">
                                    We design with your needs in mind.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- What We Do --}}
    <section class="bg-neutral-950 py-20 lg:py-28">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="max-w-3xl">

                <span class="text-sm font-semibold uppercase tracking-[3px] text-amber-400">
                    What We Do
                </span>

                <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl lg:text-5xl">
                    Designing Details That
                    <span class="text-amber-400">
                        Make a Difference
                    </span>
                </h2>

                <p class="mt-5 leading-8 text-gray-400">
                    From concept to finishing touches, we provide décor
                    solutions designed to create sophisticated and welcoming
                    spaces.
                </p>

            </div>


            <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                @php
                    $services = [
                        [
                            'title' => 'Window Décor',
                            'text' => 'Elegant curtains and window solutions designed to complement your interiors.'
                        ],
                        [
                            'title' => 'Wall Décor',
                            'text' => 'Premium wall treatments and decorative elements that add character to your space.'
                        ],
                        [
                            'title' => 'Soft Furnishings',
                            'text' => 'Beautiful cushions, fabrics and furnishings created for comfort and style.'
                        ],
                    ];
                @endphp

                @foreach ($services as $service)

                    <div class="group rounded-3xl border border-white/10 bg-white/5 p-8 transition duration-300 hover:-translate-y-2 hover:bg-white/10">

                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-full bg-amber-500 text-xl text-white">
                            ✦
                        </div>

                        <h3 class="text-xl font-semibold text-white">
                            {{ $service['title'] }}
                        </h3>

                        <p class="mt-4 leading-7 text-gray-400">
                            {{ $service['text'] }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- Stats --}}
    <section class="bg-amber-500 py-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">

                <div class="text-center text-white">
                    <h3 class="text-4xl font-bold lg:text-5xl">10+</h3>
                    <p class="mt-2 text-sm">Years Experience</p>
                </div>

                <div class="text-center text-white">
                    <h3 class="text-4xl font-bold lg:text-5xl">500+</h3>
                    <p class="mt-2 text-sm">Projects</p>
                </div>

                <div class="text-center text-white">
                    <h3 class="text-4xl font-bold lg:text-5xl">100%</h3>
                    <p class="mt-2 text-sm">Quality Focus</p>
                </div>

                <div class="text-center text-white">
                    <h3 class="text-4xl font-bold lg:text-5xl">24/7</h3>
                    <p class="mt-2 text-sm">Customer Support</p>
                </div>

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="bg-white py-20 lg:py-24">

        <div class="mx-auto max-w-5xl px-6 text-center">

            <span class="text-sm font-semibold uppercase tracking-[3px] text-amber-500">
                Let's Create Something Beautiful
            </span>

            <h2 class="mt-4 text-3xl font-bold text-neutral-900 sm:text-4xl lg:text-5xl">
                Ready to Transform Your Space?
            </h2>

            <p class="mx-auto mt-5 max-w-2xl leading-8 text-gray-600">
                Let our team help you create an interior that feels
                comfortable, elegant and uniquely yours.
            </p>

            <a
                href="{{ url('/contact') }}"
                class="mt-8 inline-flex rounded-full bg-neutral-900 px-8 py-4 font-semibold text-white transition hover:bg-amber-500"
            >
                Get In Touch →
            </a>

        </div>

    </section>

@endsection