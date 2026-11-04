
@extends('layouts.admin')

@section('title', 'Manage Testimonials')

@section('content')

<div class="admin-testimonials">

    <div class="admin-testimonials-heading">
        <div>
            <h1>Manage Testimonials</h1>
            <p>Review and manage customer feedback.</p>
        </div>
    </div>

    {{-- Statistics --}}
    <div class="admin-testimonials-stats">

        <div class="admin-stat-card">
            <span>Total Reviews</span>
            <strong>{{ $totalReviews }}</strong>
        </div>

        <div class="admin-stat-card">
            <span>Approved</span>
            <strong>{{ $approvedReviews }}</strong>
        </div>

        <div class="admin-stat-card">
            <span>Pending</span>
            <strong>{{ $pendingReviews }}</strong>
        </div>

    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="admin-testimonials-alert" role="status">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <form
        action="{{ route('admin.testimonials.index') }}"
        method="GET"
        class="admin-testimonials-filters"
    >

        <input
            type="search"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search customer or city..."
        >

        <select name="status">
            <option value="">All Reviews</option>

            <option value="pending"
                @selected(request('status') === 'pending')>
                Pending
            </option>

            <option value="approved"
                @selected(request('status') === 'approved')>
                Approved
            </option>
        </select>

        <button type="submit">Filter</button>

        <a href="{{ route('admin.testimonials.index') }}">
            Reset
        </a>

    </form>

    {{-- Reviews --}}
    <div class="admin-testimonials-table-wrap">

        <table class="admin-testimonials-table">

            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Rating</th>
                    <th>Feedback</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($testimonials as $testimonial)

                    <tr>

                        <td>
                            <strong>{{ $testimonial->name }}</strong>
                            <small>{{ $testimonial->city ?: '—' }}</small>
                        </td>

                        <td>
                            <span class="admin-review-stars">
                                {{ str_repeat('★', $testimonial->rating) }}
                            </span>
                            <small>{{ $testimonial->rating }}/5</small>
                        </td>

                        <td class="admin-review-message">
                            {{ $testimonial->message }}
                        </td>

                        <td>
                            @if($testimonial->is_approved)
                                <span class="admin-review-status approved">
                                    Approved
                                </span>
                            @else
                                <span class="admin-review-status pending">
                                    Pending
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ $testimonial->created_at->format('d M Y') }}
                        </td>

                        <td>
                            <div class="admin-review-actions">

                                @if(!$testimonial->is_approved)

                                    <form
                                        action="{{ route('admin.testimonials.approve', $testimonial) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="admin-action-approve"
                                        >
                                            Approve
                                        </button>
                                    </form>

                                @else

                                    <form
                                        action="{{ route('admin.testimonials.unapprove', $testimonial) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="admin-action-pending"
                                        >
                                            Unapprove
                                        </button>
                                    </form>

                                @endif

                                <form
                                    action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this testimonial permanently?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="admin-action-delete"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="admin-no-reviews">
                            No testimonials found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if($testimonials->hasPages())
        <div class="admin-testimonials-pagination">
            {{ $testimonials->links() }}
        </div>
    @endif

</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-testimonials.css') }}">
@endpush
