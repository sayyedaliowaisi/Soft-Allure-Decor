@extends('layouts.app')

@section('title', 'Gallery | Soft Allure Décor')

@section('content')

    {{-- Gallery Hero --}}
    <section class="relative overflow-hidden bg-neutral-950">

        <div class="absolute inset-0">
            <img
                src="{{ asset('images/gallery-hero.jpg') }}"
                alt="Soft Allure Décor Gallery"
                class="h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-black/65"></div>
        </div>

        <div class="relative z-10 mx-auto flex min-h-[50vh] max-w-7xl items-center px-6 py-24 lg:px-8">

            <div class="max-w-3xl text-white">

                <span class="text-sm font-semibold uppercase tracking-[4px] text-amber-400">
                    Our Gallery
                </span>

                <h1 class="mt-5 text-4xl font-bold leading-tight sm:text-5xl lg:text-7xl">
                    Inspiration For
                    <span class="text-amber-400">
                        Beautiful Spaces
                    </span>
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-gray-200">
                    Explore our collection of interiors, décor details and
                    furnishing solutions created to bring elegance and
                    personality to every space.
                </p>

            </div>

        </div>

    </section>


    {{-- Gallery --}}
    <section class="bg-white py-20 lg:py-28">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            {{-- Heading --}}
            <div class="text-center">

                <span class="text-sm font-semibold uppercase tracking-[3px] text-amber-500">
                    Our Work
                </span>

                <h2 class="mt-4 text-3xl font-bold text-neutral-900 sm:text-4xl lg:text-5xl">
                    Explore Our Collection
                </h2>

                <p class="mx-auto mt-5 max-w-2xl leading-8 text-gray-600">
                    A glimpse of the spaces and décor experiences created
                    with our design solutions.
                </p>

            </div>


            {{-- Gallery Grid --}}
            <div class="mt-14 columns-1 gap-5 sm:columns-2 lg:columns-3">

                @php
                    $gallery = [
                        'gallery-1.jpg',
                        'gallery-2.jpg',
                        'gallery-3.jpg',
                        'gallery-4.jpg',
                        'gallery-5.jpg',
                        'gallery-6.jpg',
                        'gallery-7.jpg',
                        'gallery-8.jpg',
                        'gallery-9.jpg',
                    ];
                @endphp


                @foreach ($gallery as $image)

                    <div class="mb-5 break-inside-avoid overflow-hidden rounded-2xl">

                        <img
                            src="{{ asset('images/gallery/' . $image) }}"
                            alt="Soft Allure Décor"
                            loading="lazy"
                            class="w-full object-cover transition duration-700 hover:scale-105"
                        >

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="bg-neutral-950 py-20">

        <div class="mx-auto max-w-4xl px-6 text-center">

            <span class="text-sm font-semibold uppercase tracking-[3px] text-amber-400">
                Your Space. Your Style.
            </span>

            <h2 class="mt-4 text-3xl font-bold text-white sm:text-4xl lg:text-5xl">
                Let's Create Your Dream Interior
            </h2>

            <p class="mx-auto mt-5 max-w-2xl leading-8 text-gray-400">
                Have an idea for your space? Get in touch with our team
                and let's turn your vision into reality.
            </p>

            <a
                href="{{ route('contact') }}"
                class="mt-8 inline-flex rounded-full bg-amber-500 px-8 py-4 font-semibold text-white transition hover:bg-amber-600"
            >
                Start Your Project →
            </a>

        </div>

    </section>

@endsection