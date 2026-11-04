
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

@php
    $stats = [
        [
            'label' => 'Total Products',
            'value' => $totalProducts,
            'icon' => 'package',
            'link' => route('admin.products.index'),
            'link_text' => 'Manage Products',
            'highlight' => false,
        ],
        [
            'label' => 'Featured Products',
            'value' => $featuredProducts,
            'icon' => 'star',
            'link' => null,
            'link_text' => 'Highlighted products',
            'highlight' => false,
        ],
        [
            'label' => 'Total Categories',
            'value' => $totalCategories,
            'icon' => 'layers-3',
            'link' => Route::has('admin.categories.index')
                ? route('admin.categories.index')
                : null,
            'link_text' => 'Manage Categories',
            'highlight' => false,
        ],
        [
            'label' => 'Total Testimonials',
            'value' => $totalTestimonials,
            'icon' => 'message-square-quote',
            'link' => route('admin.testimonials.index'),
            'link_text' => 'Manage Reviews',
            'highlight' => false,
        ],
        [
            'label' => 'Approved Reviews',
            'value' => $approvedTestimonials,
            'icon' => 'check-circle',
            'link' => null,
            'link_text' => 'Visible on public website',
            'highlight' => false,
            'approved' => true,
        ],
        [
            'label' => 'Pending Reviews',
            'value' => $pendingTestimonials,
            'icon' => 'clock-3',
            'link' => route('admin.testimonials.index', [
                'status' => 'pending'
            ]),
            'link_text' => 'Review Pending',
            'highlight' => true,
        ],
        [
            'label' => 'Total Contact Messages',
            'value' => $totalContactMessages,
            'icon' => 'mail',
            'link' => route('admin.contact-messages.index'),
            'link_text' => 'Manage Messages',
            'highlight' => false,
        ],
        [
            'label' => 'New Contact Messages',
            'value' => $newContactMessages,
            'icon' => 'mail-plus',
            'link' => route('admin.contact-messages.index', [
                'status' => 'new'
            ]),
            'link_text' => 'View New Messages',
            'highlight' => true,
        ],
        [
            'label' => 'Total Quote Requests',
            'value' => $totalQuoteRequests,
            'icon' => 'file-text',
            'link' => route('admin.quote-requests.index'),
            'link_text' => 'Manage Quotes',
            'highlight' => false,
        ],
        [
            'label' => 'New Quote Requests',
            'value' => $newQuoteRequests,
            'icon' => 'file-plus-2',
            'link' => route('admin.quote-requests.index', [
                'status' => 'new'
            ]),
            'link_text' => 'View New Quotes',
            'highlight' => true,
        ],
    ];
@endphp

<div class="space-y-8">

    {{-- DASHBOARD HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">
                Soft Allure Décor / Admin Panel
            </p>

            <h1 class="mt-2 text-3xl font-bold text-slate-900">
                Dashboard Overview
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                Welcome back! Manage your website from one place.
            </p>
        </div>

        <a
            href="{{ route('home') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
        >
            <i data-lucide="external-link" class="h-4 w-4"></i>
            <span>View Website</span>
        </a>

    </div>

    {{-- DASHBOARD STATISTICS --}}
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

        @foreach($stats as $stat)

            @php
                $isHighlight = $stat['highlight'];
                $isApproved = $stat['approved'] ?? false;
                $hasAction = $isHighlight && $stat['value'] > 0;
            @endphp

            <div class="flex min-h-[205px] flex-col justify-between rounded-2xl border p-6 shadow-sm transition hover:shadow-md
                {{ $isHighlight
                    ? 'border-amber-200 bg-amber-50'
                    : ($isApproved
                        ? 'border-emerald-100 bg-white'
                        : 'border-slate-200 bg-white') }}">

                <div>

                    <div class="flex items-start justify-between gap-3">

                        <p class="text-sm font-medium
                            {{ $isHighlight
                                ? 'text-amber-900'
                                : 'text-slate-500' }}">
                            {{ $stat['label'] }}
                        </p>

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl
                            {{ $isHighlight
                                ? 'bg-amber-100 text-amber-800'
                                : ($isApproved
                                    ? 'bg-emerald-50 text-emerald-700'
                                    : 'bg-slate-100 text-amber-700') }}">

                            <i
                                data-lucide="{{ $stat['icon'] }}"
                                class="h-5 w-5"
                                aria-hidden="true"
                            ></i>

                        </div>

                    </div>

                    <h2 class="mt-4 text-4xl font-bold
                        {{ $isHighlight
                            ? 'text-amber-800'
                            : ($isApproved
                                ? 'text-emerald-700'
                                : 'text-slate-900') }}">

                        {{ number_format((int) $stat['value']) }}

                    </h2>

                    @if($hasAction)
                        <span class="mt-3 inline-flex rounded-full bg-amber-600 px-3 py-1 text-xs font-bold text-white">
                            Action Needed
                        </span>
                    @endif

                </div>

                <div class="mt-5">

                    @if($stat['link'])

                        <a
                            href="{{ $stat['link'] }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold
                            {{ $isHighlight
                                ? 'text-amber-800'
                                : 'text-amber-700' }}
                            hover:underline"
                        >
                            {{ $stat['link_text'] }}

                            <i
                                data-lucide="arrow-right"
                                class="h-4 w-4"
                                aria-hidden="true"
                            ></i>
                        </a>

                    @else

                        <p class="text-sm text-slate-400">
                            {{ $stat['link_text'] }}
                        </p>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

    {{-- RECENT TESTIMONIALS --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 p-6">

            <div>
                <div class="flex items-center gap-3">

                    <i
                        data-lucide="message-square-quote"
                        class="h-6 w-6 text-amber-700"
                        aria-hidden="true"
                    ></i>

                    <h2 class="text-xl font-bold text-slate-900">
                        Recent Testimonials
                    </h2>

                </div>

                <p class="mt-2 text-sm text-slate-500">
                    Latest customer feedback
                </p>
            </div>

            <a
                href="{{ route('admin.testimonials.index') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-amber-700 hover:underline"
            >
                View All
                <i data-lucide="arrow-right" class="h-4 w-4"></i>
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full min-w-[650px] text-left">

                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">

                    <tr>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Rating</th>
                        <th class="px-6 py-4">Review</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($recentTestimonials as $testimonial)

                        <tr class="text-sm transition hover:bg-slate-50">

                            {{-- CUSTOMER --}}
                            <td class="px-6 py-4">

                                <span class="block font-semibold text-slate-800">
                                    {{ $testimonial->name }}
                                </span>

                                <span class="text-xs text-slate-400">
                                    {{ $testimonial->city ?: '—' }}
                                </span>

                            </td>

                            {{-- RATING --}}
                            <td class="px-6 py-4">

                                <span class="text-amber-500">
                                    {{ str_repeat('★', max(0, min(5, (int) $testimonial->rating))) }}
                                </span>

                                <span class="block text-xs text-slate-400">
                                    {{ $testimonial->rating }}/5
                                </span>

                            </td>

                            {{-- REVIEW --}}
                            <td class="max-w-xs px-6 py-4 text-slate-600">

                                <p class="max-w-xs truncate" title="{{ $testimonial->message }}">
                                    {{ $testimonial->message }}
                                </p>

                            </td>

                            {{-- STATUS --}}
                            <td class="px-6 py-4">

                                @if($testimonial->is_approved)

                                    <span class="inline-block rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                        Approved
                                    </span>

                                @else

                                    <span class="inline-block rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-800">
                                        Pending
                                    </span>

                                @endif

                            </td>

                            {{-- DATE --}}
                            <td class="px-6 py-4 text-xs text-slate-500">
                                {{ $testimonial->created_at?->format('d M Y') ?? '—' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="5"
                                class="px-6 py-12 text-center text-sm text-slate-500"
                            >
                                No customer reviews submitted yet.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        <div class="flex items-center gap-3">

            <i
                data-lucide="zap"
                class="h-6 w-6 text-amber-700"
                aria-hidden="true"
            ></i>

            <h2 class="text-xl font-bold text-slate-900">
                Quick Actions
            </h2>

        </div>

        <p class="mt-2 text-sm text-slate-500">
            Quickly access website management tools.
        </p>

        <div class="mt-6 flex flex-wrap gap-3">

            {{-- PRODUCTS --}}
            <a
                href="{{ route('admin.products.index') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700"
            >
                <i data-lucide="package" class="h-4 w-4"></i>
                Manage Products
            </a>

            {{-- CATEGORIES --}}
            @if(Route::has('admin.categories.index'))

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    <i data-lucide="layers-3" class="h-4 w-4"></i>
                    Manage Categories
                </a>

            @endif

            {{-- TESTIMONIALS --}}
            <a
                href="{{ route('admin.testimonials.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-amber-300 bg-amber-50 px-5 py-3 text-sm font-semibold text-amber-800 transition hover:bg-amber-100"
            >
                <i data-lucide="message-square-quote" class="h-4 w-4"></i>
                Manage Testimonials
            </a>

            {{-- CONTACT MESSAGES --}}
            <a
                href="{{ route('admin.contact-messages.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                <i data-lucide="mail" class="h-4 w-4"></i>
                Contact Messages
            </a>

            {{-- QUOTE REQUESTS --}}
            <a
                href="{{ route('admin.quote-requests.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-amber-300 bg-amber-50 px-5 py-3 text-sm font-semibold text-amber-800 transition hover:bg-amber-100"
            >
                <i data-lucide="file-text" class="h-4 w-4"></i>
                Manage Quote Requests
            </a>

        </div>

    </div>

</div>

@endsection
