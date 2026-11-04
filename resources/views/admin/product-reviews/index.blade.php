
@extends('layouts.admin')

@section('title', 'Product Reviews')

@section('content')

<style>
    .apr-page {
        padding: 25px;
    }

    .apr-heading {
        margin-bottom: 24px;
    }

    .apr-heading h1 {
        font-size: 27px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .apr-heading p {
        margin: 0;
        color: #777;
        font-size: 14px;
    }

    .apr-alert {
        padding: 13px 16px;
        margin-bottom: 20px;
        background: #ecfdf3;
        color: #067647;
        border-radius: 8px;
        font-size: 14px;
    }

    .apr-filters {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .apr-filter {
        display: inline-flex;
        align-items: center;
        padding: 10px 16px;
        border: 1px solid #e7e0d8;
        border-radius: 8px;
        color: #555;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        background: #fff;
        transition: 0.2s ease;
    }

    .apr-filter:hover {
        border-color: #be873c;
        color: #be873c;
    }

    .apr-filter.active {
        background: #be873c;
        border-color: #be873c;
        color: #fff;
    }

    .apr-table-wrap {
        overflow-x: auto;
        background: #fff;
        border: 1px solid #eee7df;
        border-radius: 12px;
    }

    .apr-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 13px;
    }

    .apr-table th {
        padding: 15px;
        background: #faf7f3;
        font-weight: 700;
        color: #333;
        white-space: nowrap;
    }

    .apr-table td {
        padding: 15px;
        border-top: 1px solid #f0ece7;
        vertical-align: middle;
    }

    .apr-customer-name {
        display: block;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .apr-email,
    .apr-date {
        display: block;
        font-size: 12px;
        color: #777;
    }

    .apr-product-link {
        color: #75532e;
        font-weight: 600;
        text-decoration: none;
    }

    .apr-product-link:hover {
        text-decoration: underline;
    }

    .apr-rating {
        color: #be873c;
        font-weight: 700;
        white-space: nowrap;
    }

    .apr-review-text {
        max-width: 320px;
        min-width: 180px;
        overflow-wrap: anywhere;
        line-height: 1.6;
        white-space: pre-line;
    }

    .apr-status {
        display: inline-flex;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .apr-status.pending {
        background: #fff4db;
        color: #946200;
    }

    .apr-status.approved {
        background: #e7f8ed;
        color: #187343;
    }

    .apr-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .apr-actions form {
        margin: 0;
    }

    .apr-btn {
        padding: 8px 12px;
        border: none;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: opacity 0.2s ease;
    }

    .apr-btn:hover {
        opacity: 0.85;
    }

    .apr-btn-approve {
        background: #e7f8ed;
        color: #187343;
    }

    .apr-btn-unapprove {
        background: #fff4db;
        color: #946200;
    }

    .apr-btn-delete {
        background: #feecec;
        color: #b42318;
    }

    .apr-empty {
        padding: 35px 15px !important;
        text-align: center;
        color: #777;
    }

    .apr-pagination {
        margin-top: 24px;
    }

    @media (max-width: 768px) {
        .apr-page {
            padding: 15px;
        }

        .apr-heading h1 {
            font-size: 23px;
        }

        .apr-table {
            min-width: 850px;
        }

        .apr-filter {
            padding: 9px 12px;
        }
    }
</style>

<div class="apr-page">

    {{-- PAGE HEADING --}}
    <div class="apr-heading">
        <h1>Product Reviews</h1>
        <p>
            Manage customer feedback and approve reviews
            before they appear on your website.
        </p>
    </div>

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="apr-alert" role="status">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTERS --}}
    <div class="apr-filters">

        <a
            href="{{ route('admin.product-reviews.index', ['status' => 'pending']) }}"
            class="apr-filter {{ $status === 'pending' ? 'active' : '' }}"
            @if($status === 'pending') aria-current="page" @endif
        >
            Pending Reviews
        </a>

        <a
            href="{{ route('admin.product-reviews.index', ['status' => 'approved']) }}"
            class="apr-filter {{ $status === 'approved' ? 'active' : '' }}"
            @if($status === 'approved') aria-current="page" @endif
        >
            Approved Reviews
        </a>

        <a
            href="{{ route('admin.product-reviews.index', ['status' => 'all']) }}"
            class="apr-filter {{ $status === 'all' ? 'active' : '' }}"
            @if($status === 'all') aria-current="page" @endif
        >
            All Reviews
        </a>

    </div>

    {{-- REVIEWS TABLE --}}
    <div class="apr-table-wrap">

        <table class="apr-table">

            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                @forelse($reviews as $review)

                    <tr>

                        {{-- CUSTOMER --}}
                        <td>
                            <strong class="apr-customer-name">
                                {{ $review->name }}
                            </strong>

                            <span class="apr-email">
                                {{ $review->email }}
                            </span>

                            <span class="apr-date">
                                {{ $review->created_at?->format('d M Y') }}
                            </span>
                        </td>

                        {{-- PRODUCT --}}
                        <td>
                            @if($review->product)
                                <a
                                    href="{{ route('admin.products.edit', $review->product) }}"
                                    class="apr-product-link"
                                >
                                    {{ $review->product->name }}
                                </a>
                            @else
                                <span>Deleted Product</span>
                            @endif
                        </td>

                        {{-- RATING --}}
                        <td>
                            <span class="apr-rating">
                                {{ $review->rating }} ★
                            </span>
                        </td>

                        {{-- REVIEW --}}
                        <td>
                            <div class="apr-review-text">
                                {{ $review->review }}
                            </div>
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($review->is_approved)
                                <span class="apr-status approved">
                                    Approved
                                </span>
                            @else
                                <span class="apr-status pending">
                                    Pending
                                </span>
                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td>
                            <div class="apr-actions">

                                @if(!$review->is_approved)

                                    <form
                                        action="{{ route('admin.product-reviews.approve', $review) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="apr-btn apr-btn-approve"
                                        >
                                            Approve
                                        </button>
                                    </form>

                                @else

                                    <form
                                        action="{{ route('admin.product-reviews.reject', $review) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="apr-btn apr-btn-unapprove"
                                        >
                                            Unapprove
                                        </button>
                                    </form>

                                @endif

                                <form
                                    action="{{ route('admin.product-reviews.destroy', $review) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to permanently delete this review?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="apr-btn apr-btn-delete"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="apr-empty">
                            No reviews found.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- PAGINATION --}}
    @if($reviews->hasPages())
        <div class="apr-pagination">
            {{ $reviews->links() }}
        </div>
    @endif

</div>

@endsection
