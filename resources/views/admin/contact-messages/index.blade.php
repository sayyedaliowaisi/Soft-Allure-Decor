
@extends('layouts.admin')

@section('title', 'Contact Messages')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-contact-messages.css') }}">
@endpush

@section('content')

<div class="acm-page">

    {{-- PAGE HEADER --}}
    <div class="acm-header">
        <div>
            <span class="acm-eyebrow">SOFT ALLURE DÉCOR / ADMIN</span>
            <h1>Contact Messages</h1>
            <p>Manage customer enquiries received from your website.</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="acm-back">
            ← Dashboard
        </a>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="acm-alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- STATISTICS --}}
    <div class="acm-stats">
        <div class="acm-stat">
            <span>Total Messages</span>
            <strong>{{ $stats['total'] }}</strong>
        </div>

        <div class="acm-stat acm-stat-new">
            <span>New Messages</span>
            <strong>{{ $stats['new'] }}</strong>
        </div>

        <div class="acm-stat">
            <span>Read Messages</span>
            <strong>{{ $stats['read'] }}</strong>
        </div>

        <div class="acm-stat">
            <span>Replied Messages</span>
            <strong>{{ $stats['replied'] }}</strong>
        </div>
    </div>

    {{-- SEARCH AND FILTER --}}
    <form method="GET"
          action="{{ route('admin.contact-messages.index') }}"
          class="acm-filters">

        <div class="acm-search">
            <label for="message-search">Search messages</label>
            <input
                id="message-search"
                type="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search name, email or subject..."
            >
        </div>

        <div class="acm-filter">
            <label for="message-status">Status</label>

            <select id="message-status" name="status">
                <option value="all" @selected($status === 'all')>
                    All Messages
                </option>
                <option value="new" @selected($status === 'new')>
                    New
                </option>
                <option value="read" @selected($status === 'read')>
                    Read
                </option>
                <option value="replied" @selected($status === 'replied')>
                    Replied
                </option>
            </select>
        </div>

        <button type="submit" class="acm-btn acm-btn-dark">
            Apply Filters
        </button>

        <a href="{{ route('admin.contact-messages.index') }}"
           class="acm-btn acm-btn-light">
            Reset
        </a>
    </form>

    {{-- MESSAGES TABLE --}}
    <div class="acm-table-wrap">
        <div class="acm-table-scroll">
            <table class="acm-table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Received</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td>
                                <strong>{{ $message->name }}</strong>
                                <small>{{ $message->email }}</small>
                            </td>

                            <td>{{ $message->subject }}</td>

                            <td>
                                <div class="acm-message-preview">
                                    {{ \Illuminate\Support\Str::limit($message->message, 85) }}
                                </div>
                            </td>

                            <td>
                                <span class="acm-status acm-status-{{ $message->status }}">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $message->created_at?->format('d M Y') ?? '—' }}
                                <small>
                                    {{ $message->created_at?->format('h:i A') ?? '' }}
                                </small>
                            </td>

                            <td>
                                <a href="{{ route('admin.contact-messages.show', $message) }}"
                                   class="acm-view-link">
                                    View Details →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="acm-empty">
                                No contact messages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if($messages->hasPages())
        <div class="acm-pagination">
            {{ $messages->links() }}
        </div>
    @endif

</div>

@endsection
