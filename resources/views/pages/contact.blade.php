@extends('layouts.app')

@section('title', 'Contact Us | Soft Allure Décor')

@section('content')

    {{-- Contact Hero --}}
    <section class="relative overflow-hidden bg-neutral-950">

        <div class="absolute inset-0">
            <img
                src="{{ asset('images/contact-hero.jpg') }}"
                alt="Contact Soft Allure Décor"
                class="h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-black/65"></div>
        </div>

        <div class="relative z-10 mx-auto flex min-h-[50vh] max-w-7xl items-center px-6 py-24 lg:px-8">

            <div class="max-w-3xl text-white">

                <span class="text-sm font-semibold uppercase tracking-[4px] text-amber-400">
                    Contact Us
                </span>

                <h1 class="mt-5 text-4xl font-bold leading-tight sm:text-5xl lg:text-7xl">
                    Let's Create Something
                    <span class="text-amber-400">
                        Beautiful
                    </span>
                </h1>

                <p class="mt-6 max-w-2xl text-lg leading-8 text-gray-200">
                    Have a project in mind? Get in touch with our team and
                    let's discuss how we can transform your space.
                </p>

            </div>

        </div>

    </section>


    {{-- Contact Section --}}
    <section class="bg-white py-20 lg:py-28">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid gap-14 lg:grid-cols-2">

                {{-- Contact Information --}}
                <div>

                    <span class="text-sm font-semibold uppercase tracking-[3px] text-amber-500">
                        Get In Touch
                    </span>

                    <h2 class="mt-4 text-3xl font-bold text-neutral-900 sm:text-4xl">
                        We'd Love To Hear From You
                    </h2>

                    <p class="mt-6 max-w-xl leading-8 text-gray-600">
                        Whether you're planning a complete interior makeover
                        or simply looking for the perfect décor piece, our
                        team is here to help.
                    </p>


                    <div class="mt-10 space-y-6">

                        {{-- Phone --}}
                        <a
                            href="tel:+919311036306"
                            class="flex items-center gap-5 rounded-2xl border border-gray-100 p-5 transition hover:-translate-y-1 hover:shadow-lg"
                        >

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                ☎
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Call Us
                                </p>

                                <p class="mt-1 font-semibold text-neutral-900">
                                    +91 9311036306
                                </p>
                            </div>

                        </a>


                        {{-- Email --}}
                        <a
                            href="mailto:softallure.decor@gmail.com"
                            class="flex items-center gap-5 rounded-2xl border border-gray-100 p-5 transition hover:-translate-y-1 hover:shadow-lg"
                        >

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                ✉
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Email Us
                                </p>

                                <p class="mt-1 break-all font-semibold text-neutral-900">
                                    softallure.decor@gmail.com
                                </p>
                            </div>

                        </a>


                        {{-- Location --}}
                        <div class="flex items-center gap-5 rounded-2xl border border-gray-100 p-5">

                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                📍
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">
                                    Visit Us
                                </p>

                                <p class="mt-1 font-semibold text-neutral-900">
                                    Delhi NCR, India
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Contact Form --}}
                <div class="rounded-3xl bg-neutral-950 p-7 shadow-2xl sm:p-10">

                    <h3 class="text-2xl font-bold text-white">
                        Send Us A Message
                    </h3>

                    <p class="mt-2 text-gray-400">
                        Fill out the form and our team will get back to you.
                    </p>

                    <form class="mt-8 space-y-5">

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Your Name
                            </label>

                            <input
                                type="text"
                                placeholder="Enter your name"
                                class="w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-gray-500 outline-none transition focus:border-amber-500"
                            >
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Email Address
                            </label>

                            <input
                                type="email"
                                placeholder="Enter your email"
                                class="w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-gray-500 outline-none transition focus:border-amber-500"
                            >
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Phone Number
                            </label>

                            <input
                                type="tel"
                                placeholder="Enter your phone number"
                                class="w-full rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-gray-500 outline-none transition focus:border-amber-500"
                            >
                        </div>


                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Message
                            </label>

                            <textarea
                                rows="5"
                                placeholder="Tell us about your project..."
                                class="w-full resize-none rounded-xl border border-white/10 bg-white/5 px-5 py-4 text-white placeholder-gray-500 outline-none transition focus:border-amber-500"
                            ></textarea>
                        </div>


                        <button
                            type="button"
                            class="w-full rounded-xl bg-amber-500 px-6 py-4 font-semibold text-white transition hover:bg-amber-600"
                        >
                            Send Message →
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>


    {{-- CTA --}}
    <section class="bg-amber-500 py-16">

        <div class="mx-auto max-w-4xl px-6 text-center">

            <h2 class="text-3xl font-bold text-white sm:text-4xl">
                Ready To Transform Your Space?
            </h2>

            <p class="mx-auto mt-4 max-w-2xl leading-7 text-white/90">
                Talk to our team about your interior décor requirements.
            </p>

            <a
                href="tel:+919311036306"
                class="mt-7 inline-flex rounded-full bg-neutral-950 px-8 py-4 font-semibold text-white transition hover:bg-white hover:text-neutral-950"
            >
                Call Us Now
            </a>

        </div>

    </section>

@endsection