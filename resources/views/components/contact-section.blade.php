<section class="relative py-24 lg:py-32 bg-white overflow-hidden">

    <!-- Decorative Background -->
    <div class="absolute -top-40 -right-40 w-[450px] h-[450px]
                bg-yellow-100 rounded-full blur-3xl opacity-60"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Heading -->
        <div class="max-w-3xl">

            <span class="inline-flex px-4 py-2 rounded-full
                         bg-yellow-100
                         text-yellow-700
                         text-sm font-semibold">

                GET IN TOUCH

            </span>

            <h2 class="mt-6 text-4xl md:text-5xl lg:text-6xl
                       font-black text-gray-900 leading-tight">

                Let's Discuss Your
                <span class="text-yellow-500">
                    Next Project
                </span>

            </h2>

            <p class="mt-6 text-lg text-gray-600 leading-8">

                Tell us about your requirements and our team will
                get back to you with the right décor solution.

            </p>

        </div>


        <!-- Contact Grid -->
        <div class="mt-16 grid lg:grid-cols-5 gap-10">


            <!-- Contact Information -->
            <div class="lg:col-span-2">

                <div class="h-full rounded-3xl bg-gray-950 text-white p-8 lg:p-10">

                    <span class="text-yellow-400 text-sm font-semibold uppercase tracking-wider">
                        Contact Information
                    </span>

                    <h3 class="mt-4 text-3xl font-bold">
                        Start a Conversation
                    </h3>

                    <p class="mt-4 text-gray-400 leading-7">
                        Have a product enquiry, custom requirement,
                        or interior project? We're here to help.
                    </p>


                    <!-- Email -->
                    <div class="mt-10 flex gap-4">

                        <div class="w-12 h-12 shrink-0 rounded-xl
                                    bg-yellow-500/10
                                    flex items-center justify-center
                                    text-yellow-400 text-xl">
                            @
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Email
                            </p>

                            <a href="mailto:info@example.com"
                               class="mt-1 block font-medium hover:text-yellow-400 transition">
                                info@example.com
                            </a>

                        </div>

                    </div>


                    <!-- Phone -->
                    <div class="mt-7 flex gap-4">

                        <div class="w-12 h-12 shrink-0 rounded-xl
                                    bg-yellow-500/10
                                    flex items-center justify-center
                                    text-yellow-400 text-xl">
                            ☎
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Phone
                            </p>

                            <a href="tel:+910000000000"
                               class="mt-1 block font-medium hover:text-yellow-400 transition">
                                +91 00000 00000
                            </a>

                        </div>

                    </div>


                    <!-- Location -->
                    <div class="mt-7 flex gap-4">

                        <div class="w-12 h-12 shrink-0 rounded-xl
                                    bg-yellow-500/10
                                    flex items-center justify-center
                                    text-yellow-400 text-xl">
                            ⌖
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Location
                            </p>

                            <p class="mt-1 font-medium">
                                India
                            </p>

                        </div>

                    </div>


                    <!-- Response -->
                    <div class="mt-10 pt-8 border-t border-white/10">

                        <div class="flex items-center gap-3">

                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>

                            <p class="text-sm text-gray-400">
                                We're available for new enquiries
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Form -->
            <div class="lg:col-span-3">

                <div class="bg-gray-50 rounded-3xl p-8 lg:p-10 border border-gray-100">

                    <h3 class="text-2xl font-bold text-gray-900">
                        Request a Free Quote
                    </h3>

                    <p class="mt-2 text-gray-500">
                        Fill in your details and tell us about your project.
                    </p>


                    <form action="{{ route('contact') }}"
                          method="POST"
                          class="mt-8 space-y-6">

                        @csrf


                        <!-- Name + Email -->
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Your Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    placeholder="Enter your name"
                                    required
                                    class="w-full px-5 py-4 rounded-xl
                                           border border-gray-200
                                           bg-white
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-yellow-400
                                           focus:border-transparent">

                            </div>


                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    placeholder="you@example.com"
                                    required
                                    class="w-full px-5 py-4 rounded-xl
                                           border border-gray-200
                                           bg-white
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-yellow-400
                                           focus:border-transparent">

                            </div>

                        </div>


                        <!-- Phone + Company -->
                        <div class="grid md:grid-cols-2 gap-5">

                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Phone Number
                                </label>

                                <input
                                    type="tel"
                                    name="phone"
                                    placeholder="+91"
                                    class="w-full px-5 py-4 rounded-xl
                                           border border-gray-200
                                           bg-white
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-yellow-400
                                           focus:border-transparent">

                            </div>


                            <div>

                                <label class="block mb-2 text-sm font-semibold text-gray-700">
                                    Company
                                </label>

                                <input
                                    type="text"
                                    name="company"
                                    placeholder="Company name"
                                    class="w-full px-5 py-4 rounded-xl
                                           border border-gray-200
                                           bg-white
                                           focus:outline-none
                                           focus:ring-2
                                           focus:ring-yellow-400
                                           focus:border-transparent">

                            </div>

                        </div>


                        <!-- Requirement -->
                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                What are you looking for?
                            </label>

                            <select
                                name="requirement"
                                class="w-full px-5 py-4 rounded-xl
                                       border border-gray-200
                                       bg-white
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-yellow-400
                                       focus:border-transparent">

                                <option value="">
                                    Select an option
                                </option>

                                <option value="wall-panels">
                                    Decorative Wall Panels
                                </option>

                                <option value="cushions">
                                    Decorative Cushions
                                </option>

                                <option value="custom">
                                    Custom Décor Solution
                                </option>

                                <option value="bulk">
                                    Bulk / Wholesale Enquiry
                                </option>

                                <option value="other">
                                    Other
                                </option>

                            </select>

                        </div>


                        <!-- Message -->
                        <div>

                            <label class="block mb-2 text-sm font-semibold text-gray-700">
                                Project Details
                            </label>

                            <textarea
                                name="message"
                                rows="5"
                                placeholder="Tell us about your project or requirements..."
                                required
                                class="w-full px-5 py-4 rounded-xl
                                       border border-gray-200
                                       bg-white
                                       resize-none
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-yellow-400
                                       focus:border-transparent"></textarea>

                        </div>


                        <!-- Submit -->
                        <button
                            type="submit"
                            class="w-full py-4 rounded-xl
                                   bg-gray-950
                                   hover:bg-yellow-500
                                   hover:text-black
                                   text-white
                                   font-bold
                                   transition duration-300">

                            Send Enquiry →

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>