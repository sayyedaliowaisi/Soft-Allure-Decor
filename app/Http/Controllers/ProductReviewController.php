<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        // Only active products in active categories
        // can receive customer reviews.
        abort_unless(
            $product->status &&
            $product->category()
                ->where('status', true)
                ->exists(),
            404
        );

        // Validate customer review.
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'rating' => [
                'required',
                'integer',
                'between:1,5',
            ],
            'review' => [
                'required',
                'string',
                'min:10',
                'max:2000',
            ],
            'website' => [
                'nullable',
                'max:0',
            ],
        ]);

        // Store as pending review.
        ProductReview::create([
            'product_id' => $product->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'rating' => $validated['rating'],
            'review' => $validated['review'],
            'is_approved' => false,
        ]);

        // Return to product reviews section.
        return redirect()
            ->route('products.show', $product->slug)
            ->with(
                'review_success',
                'Thank you! Your review has been submitted and is awaiting approval.'
            )
            ->withFragment('productReviews');
    }
}
