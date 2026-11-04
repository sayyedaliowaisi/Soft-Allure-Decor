
@extends('layouts.admin')

@section('title', 'Quote Requests')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-quote-requests.css') }}">
@endpush

@section('content')

<div class="aqr-page">

    {{-- HEADER --}}
    <div class="aqr-header">
        <div>
            <span class="aqr-eyebrow">
                SOFT ALLURE DÉCOR / ADMIN
            </span>

            <h1>Quote Requests</h1>

            <p>
                Manage customer quotations and project enquiries.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="aqr-back">
            ← Dashboard
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="aqr-alert" role="status">
            {{ session('success') }}
        </div>
    @endif

    {{-- STATISTICS --}}
    <div class="aqr-stats">

        <div class="aqr-stat">
            <span>Total Requests</span>
            <strong>{{ $stats['total'] }}</strong>
        </div>

        <div class="aqr-stat aqr-stat-new">
            <span>New Requests</span>
            <strong>{{ $stats['new'] }}</strong>
        </div>

        <div class="aqr-stat">
            <span>Read Requests</span>
            <strong>{{ $stats['read'] }}</strong>
        </div>

        <div class="aqr-stat">
            <span>Replied Requests</span>
            <strong>{{ $stats['replied'] }}</strong>
        </div>

    </div>

    {{-- SEARCH & FILTER --}}
    <form method="GET"
          action="{{ route('admin.quote-requests.index') }}"
          class="aqr-filters">

        <div class="aqr-field aqr-search">
            <label for="quote-search">
                Search Requests
            </label>

            <input
                type="search"
                id="quote-search"
                name="search"
                value="{{ $search }}"
                placeholder="Name, email, phone, city or category..."
            >
        </div>

        <div class="aqr-field aqr-filter">
            <label for="quote-status">
                Status
            </label>

            <select id="quote-status" name="status">
                <option value="all"
                    @selected($status === 'all')>
                    All Requests
                </option>

                <option value="new"
                    @selected($status === 'new')>
                    New
                </option>

                <option value="read"
                    @selected($status === 'read')>
                    Read
                </option>

                <option value="replied"
                    @selected($status === 'replied')>
                    Replied
                </option>
            </select>
        </div>

        <button type="submit"
                class="aqr-btn aqr-btn-dark">
            Apply Filters
        </button>

        <a href="{{ route('admin.quote-requests.index') }}"
           class="aqr-btn aqr-btn-light">
            Reset
        </a>

    </form>

    {{-- REQUESTS TABLE --}}
    <div class="aqr-table-wrap">
        <div class="aqr-table-scroll">

            <table class="aqr-table">

                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Category</th>
                        <th>Products</th>
                        <th>Budget</th>
                        <th>Timeline</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($quotes as $quote)

                        <tr>

                            {{-- CUSTOMER --}}
                            <td>
                                <strong>
                                    {{ $quote->name }}
                                </strong>

                                <small>
                                    {{ $quote->email }}
                                </small>

                                <small>
                                    {{ $quote->phone }}
                                </small>
                            </td>

                            {{-- CATEGORY --}}
                            <td>
                                {{ $quote->category }}
                            </td>

                            {{-- SELECTED PRODUCTS --}}
                            <td>
                                @php
                                    $selectedProducts = is_array($quote->products)
                                        ? $quote->products
                                        : [];
                                @endphp

                                @if(count($selectedProducts) > 0)
                                    <strong>
                                        {{ count($selectedProducts) }}
                                        {{ count($selectedProducts) === 1 ? 'Product' : 'Products' }}
                                    </strong>
                                @else
                                    <span>General Enquiry</span>
                                @endif
                            </td>

                            {{-- BUDGET --}}
                            <td>
                                {{ $quote->budget ?: 'Not specified' }}
                            </td>

                            {{-- TIMELINE --}}
                            <td>
                                {{ $quote->timeline ?: 'Not specified' }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                <span class="aqr-status aqr-status-{{ $quote->status }}">
                                    {{ ucfirst($quote->status) }}
                                </span>
                            </td>

                            {{-- RECEIVED --}}
                            <td>
                                {{ $quote->created_at?->format('d M Y') ?? '—' }}

                                <small>
                                    {{ $quote->created_at?->format('h:i A') ?? '' }}
                                </small>
                            </td>

                            {{-- ACTION --}}
                            <td>
                                <a href="{{ route('admin.quote-requests.show', $quote) }}"
                                   class="aqr-view">
                                    View Details →
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="aqr-empty">
                                No quote requests found.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    {{-- PAGINATION --}}
    @if($quotes->hasPages())
        <div class="aqr-pagination">
            {{ $quotes->links() }}
        </div>
    @endif

</div>

@endsection
