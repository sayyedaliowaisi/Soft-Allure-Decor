<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $query = Testimonial::query()->latest();

        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->paginate(10)->withQueryString();

        $totalReviews = Testimonial::count();
        $approvedReviews = Testimonial::where('is_approved', true)->count();
        $pendingReviews = Testimonial::where('is_approved', false)->count();

        return view('admin.testimonials.index', compact(
            'testimonials',
            'totalReviews',
            'approvedReviews',
            'pendingReviews'
        ));
    }

    public function approve(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_approved' => true]);

        return back()->with(
            'success',
            'Testimonial approved successfully.'
        );
    }

    public function unapprove(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->update(['is_approved' => false]);

        return back()->with(
            'success',
            'Testimonial moved to pending.'
        );
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        $testimonial->delete();

        return back()->with(
            'success',
            'Testimonial deleted successfully.'
        );
    }
}
