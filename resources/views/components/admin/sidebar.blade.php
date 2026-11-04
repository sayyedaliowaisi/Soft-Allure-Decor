
@php
    /*
    |--------------------------------------------------------------------------
    | SIDEBAR NOTIFICATION COUNTS
    |--------------------------------------------------------------------------
    */

    $newContactMessages = Route::has('admin.contact-messages.index')
        ? \App\Models\ContactMessage::where('status', 'new')->count()
        : 0;

    $newQuoteRequests = Route::has('admin.quote-requests.index')
        ? \App\Models\QuoteRequest::where(
            'status',
            \App\Models\QuoteRequest::STATUS_NEW
        )->count()
        : 0;

    $pendingTestimonialCount = Route::has('admin.testimonials.index')
        ? \App\Models\Testimonial::where('is_approved', false)->count()
        : 0;
@endphp

<aside
    id="adminSidebar"
    class="admin-sidebar"
    aria-label="Admin sidebar"
>

    {{-- =====================================
         BRAND / HEADER
    ===================================== --}}

    <div class="flex shrink-0 items-center justify-between border-b border-slate-700 p-6">

        <div>
            <a
                href="{{ route('admin.dashboard') }}"
                class="block text-2xl font-bold text-white transition hover:text-amber-400"
            >
                Soft Allure
            </a>

            <p class="mt-1 text-sm text-slate-400">
                Admin Panel
            </p>
        </div>

        {{-- MOBILE CLOSE BUTTON --}}
        <button
            type="button"
            id="adminMenuClose"
            class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-700 text-slate-300 transition hover:bg-slate-800 lg:hidden"
            aria-label="Close admin menu"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
                aria-hidden="true"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>

    {{-- =====================================
         SCROLLABLE NAVIGATION
    ===================================== --}}

    <nav
        class="admin-sidebar-nav space-y-1 px-3 py-6"
        aria-label="Admin navigation"
    >

        {{-- DASHBOARD --}}
        <a
            href="{{ route('admin.dashboard') }}"
            @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif
            class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
            {{ request()->routeIs('admin.dashboard')
                ? 'bg-amber-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
            <i data-lucide="layout-dashboard" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
            <span>Dashboard</span>
        </a>

        {{-- PRODUCTS --}}
        <a
            href="{{ route('admin.products.index') }}"
            @if(request()->routeIs('admin.products.*')) aria-current="page" @endif
            class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
            {{ request()->routeIs('admin.products.*')
                ? 'bg-amber-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
            <i data-lucide="package" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
            <span>Products</span>
        </a>

        {{-- CATEGORIES --}}
        <a
            href="{{ route('admin.categories.index') }}"
            @if(request()->routeIs('admin.categories.*')) aria-current="page" @endif
            class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
            {{ request()->routeIs('admin.categories.*')
                ? 'bg-amber-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
            <i data-lucide="layers-3" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
            <span>Categories</span>
        </a>

        {{-- GALLERY --}}
        @if(Route::has('admin.gallery.index'))
            <a
                href="{{ route('admin.gallery.index') }}"
                @if(request()->routeIs('admin.gallery.*')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('admin.gallery.*')
                    ? 'bg-amber-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >
                <i data-lucide="images" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                <span>Gallery</span>
            </a>
        @endif

        {{-- =====================================
             CUSTOMER ENQUIRIES
        ===================================== --}}

        <div class="px-4 pb-2 pt-6">
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">
                Customer Enquiries
            </p>
        </div>

        {{-- CONTACT MESSAGES --}}
        @if(Route::has('admin.contact-messages.index'))
            <a
                href="{{ route('admin.contact-messages.index') }}"
                @if(request()->routeIs('admin.contact-messages.*')) aria-current="page" @endif
                class="flex items-center justify-between gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('admin.contact-messages.*')
                    ? 'bg-amber-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >
                <span class="flex min-w-0 items-center gap-3">
                    <i data-lucide="mail" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                    <span>Contact Messages</span>
                </span>

                @if($newContactMessages > 0)
                    <span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">
                        {{ $newContactMessages }}
                    </span>
                @endif
            </a>
        @endif

        {{-- QUOTE REQUESTS --}}
        @if(Route::has('admin.quote-requests.index'))
            <a
                href="{{ route('admin.quote-requests.index') }}"
                @if(request()->routeIs('admin.quote-requests.*')) aria-current="page" @endif
                class="flex items-center justify-between gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('admin.quote-requests.*')
                    ? 'bg-amber-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >
                <span class="flex min-w-0 items-center gap-3">
                    <i data-lucide="file-text" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                    <span>Quote Requests</span>
                </span>

                @if($newQuoteRequests > 0)
                    <span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">
                        {{ $newQuoteRequests }}
                    </span>
                @endif
            </a>
        @endif

        {{-- =====================================
             WEBSITE MANAGEMENT
        ===================================== --}}

        <div class="px-4 pb-2 pt-6">
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">
                Website Management
            </p>
        </div>

        {{-- TESTIMONIALS --}}
        <a
            href="{{ route('admin.testimonials.index') }}"
            @if(request()->routeIs('admin.testimonials.*')) aria-current="page" @endif
            class="flex items-center justify-between gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
            {{ request()->routeIs('admin.testimonials.*')
                ? 'bg-amber-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
        >
            <span class="flex min-w-0 items-center gap-3">
                <i data-lucide="message-square-quote" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                <span>Testimonials</span>
            </span>

            @if($pendingTestimonialCount > 0)
                <span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">
                    {{ $pendingTestimonialCount }}
                </span>
            @endif
        </a>

        {{-- CUSTOMER PRODUCT REVIEWS --}}
        @if(Route::has('admin.product-reviews.index'))
            <a
                href="{{ route('admin.product-reviews.index') }}"
                @if(request()->routeIs('admin.product-reviews.*')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('admin.product-reviews.*')
                    ? 'bg-amber-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >
                <i data-lucide="star" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                <span>Customer Reviews</span>
            </a>
        @endif

        {{-- SETTINGS --}}
        @if(Route::has('admin.settings.index'))
            <a
                href="{{ route('admin.settings.index') }}"
                @if(request()->routeIs('admin.settings.*')) aria-current="page" @endif
                class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium transition
                {{ request()->routeIs('admin.settings.*')
                    ? 'bg-amber-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >
                <i data-lucide="settings" class="h-5 w-5 shrink-0" aria-hidden="true"></i>
                <span>Settings</span>
            </a>
        @endif

    </nav>

    {{-- =====================================
         BOTTOM SECTION
    ===================================== --}}

    <div class="shrink-0 space-y-3 border-t border-slate-700 p-5">

        {{-- VIEW WEBSITE --}}
        <a
            href="{{ route('home') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="flex min-h-11 items-center justify-center gap-2 rounded-lg border border-slate-600 px-4 py-3 text-center text-sm font-medium text-slate-300 transition hover:border-amber-500 hover:bg-slate-800 hover:text-white"
        >
            <i data-lucide="external-link" class="h-4 w-4 shrink-0" aria-hidden="true"></i>
            <span>View Website</span>
        </a>

        {{-- LOGOUT --}}
        <form
            method="POST"
            action="{{ route('admin.logout') }}"
            class="w-full"
        >
            @csrf

            <button
                type="submit"
                class="flex min-h-11 w-full items-center justify-center gap-2 rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm font-semibold text-red-300 transition hover:border-red-500 hover:bg-red-600 hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-400"
            >
                <i data-lucide="log-out" class="h-5 w-5" aria-hidden="true"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>
