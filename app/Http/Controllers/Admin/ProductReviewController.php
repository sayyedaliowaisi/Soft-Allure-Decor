<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductReviewController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'pending');

        if (!in_array($status, [
            'pending',
            'approved',
            'all',
        ], true)) {
            $status = 'pending';
        }

        $reviews = ProductReview::query()
            ->with('product')
            ->when($status === 'pending', function ($query) {
                $query->where('is_approved', false);
            })
            ->when($status === 'approved', function ($query) {
                $query->where('is_approved', true);
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.product-reviews.index',
            compact('reviews', 'status')
        );
    }

    public function approve(ProductReview $review): RedirectResponse
    {
        $review->update([
            'is_approved' => true,
        ]);

        return back()->with(
            'success',
            'Review approved successfully.'
        );
    }

    public function reject(ProductReview $review): RedirectResponse
    {
        $review->update([
            'is_approved' => false,
        ]);

        return back()->with(
            'success',
            'Review moved to pending.'
        );
    }

    public function destroy(ProductReview $review): RedirectResponse
    {
        $review->delete();

        return back()->with(
            'success',
            'Review deleted successfully.'
        );
    }
}
