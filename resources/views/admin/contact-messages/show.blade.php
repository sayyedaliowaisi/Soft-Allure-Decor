
@extends('layouts.admin')

@section('title', 'Contact Message Details')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-contact-messages.css') }}">
@endpush

@section('content')

<div class="acm-page">

    <div class="acm-header">
        <div>
            <span class="acm-eyebrow">CUSTOMER ENQUIRY</span>
            <h1>Message Details</h1>
            <p>Review and manage this customer enquiry.</p>
        </div>

        <a href="{{ route('admin.contact-messages.index') }}"
           class="acm-back">
            ← All Messages
        </a>
    </div>

    @if(session('success'))
        <div class="acm-alert">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="acm-error" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="acm-details-grid">

        {{-- MAIN MESSAGE --}}
        <section class="acm-detail-card">

            <div class="acm-detail-heading">
                <h2>Customer Message</h2>

                <span class="acm-status acm-status-{{ $contactMessage->status }}">
                    {{ ucfirst($contactMessage->status) }}
                </span>
            </div>

            <div class="acm-detail-fields">

                <div>
                    <span>Customer Name</span>
                    <strong>{{ $contactMessage->name }}</strong>
                </div>

                <div>
                    <span>Email Address</span>
                    <a href="mailto:{{ $contactMessage->email }}">
                        {{ $contactMessage->email }}
                    </a>
                </div>

                <div>
                    <span>Phone Number</span>
                    @if($contactMessage->phone)
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactMessage->phone) }}">
                            {{ $contactMessage->phone }}
                        </a>
                    @else
                        <strong>Not provided</strong>
                    @endif
                </div>

                <div>
                    <span>Subject</span>
                    <strong>{{ $contactMessage->subject }}</strong>
                </div>

                <div>
                    <span>Received On</span>
                    <strong>
                        {{ $contactMessage->created_at?->format('d M Y, h:i A') ?? '—' }}
                    </strong>
                </div>

            </div>

            <div class="acm-full-message">
                <h3>Message</h3>

                <p>{{ $contactMessage->message }}</p>
            </div>

        </section>

        {{-- ACTIONS --}}
        <aside class="acm-detail-card acm-action-card">

            <h2>Manage Enquiry</h2>

            <p class="acm-action-description">
                Update the enquiry status or respond to the customer.
            </p>

            <form method="POST"
                  action="{{ route('admin.contact-messages.status', $contactMessage) }}">

                @csrf
                @method('PATCH')

                <label for="contact-message-status">
                    Message Status
                </label>

                <select id="contact-message-status"
                        name="status"
                        required>

                    <option value="new" @selected($contactMessage->status === 'new')>
                        New
                    </option>

                    <option value="read" @selected($contactMessage->status === 'read')>
                        Read
                    </option>

                    <option value="replied" @selected($contactMessage->status === 'replied')>
                        Replied
                    </option>

                </select>

                <button type="submit" class="acm-btn acm-btn-dark acm-full-btn">
                    Update Status
                </button>

            </form>

            <a
                href="mailto:{{ $contactMessage->email }}?subject={{ rawurlencode('Re: ' . $contactMessage->subject) }}"
                class="acm-btn acm-btn-gold acm-full-btn"
            >
                Reply by Email
            </a>

            <p class="acm-action-description">
                The reply button opens your email application. Mark the
                enquiry as Replied after sending your response.
            </p>

            <form
                method="POST"
                action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                onsubmit="return confirm('Are you sure you want to permanently delete this message?')"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="acm-btn acm-btn-danger acm-full-btn">
                    Delete Message
                </button>
            </form>

        </aside>

    </div>

</div>

@endsection
