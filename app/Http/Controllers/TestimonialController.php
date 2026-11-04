<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display approved testimonials.
     */
    public function index(): View
    {
        $testimonials = Testimonial::query()
            ->approved()
            ->latest()
            ->paginate(6);

        return view(
            'pages.testimonials',
            compact('testimonials')
        );
    }

    /**
     * Store a customer review for moderation.
     */
    public function store(Request $request): RedirectResponse
    {
        // Honeypot: silently ignore likely bot submissions.
        if ($request->filled('website')) {
            return redirect()
                ->route('testimonials')
                ->with(
                    'review_success',
                    'Thank you for sharing your feedback.'
                );
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'rating' => [
                'required',
                'integer',
                'between:1,5',
            ],

            'message' => [
                'required',
                'string',
                'min:10',
                'max:2000',
            ],
        ]);

        // Never accept approval status from public input.
        $validated['is_approved'] = false;

        Testimonial::create($validated);

        return redirect()
            ->route('testimonials')
            ->with(
                'review_success',
                'Thank you! Your review has been submitted for approval.'
            );
    }
}
