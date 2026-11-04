<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\ContactMessage;
use Illuminate\View\View;
use App\Models\QuoteRequest;

class DashboardController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | PRODUCTS STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $featuredProducts = Product::where(
            'featured',
            true
        )->count();

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalCategories = Category::count();

        /*
        |--------------------------------------------------------------------------
        | TESTIMONIALS STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalTestimonials = Testimonial::count();

        $approvedTestimonials = Testimonial::where(
            'is_approved',
            true
        )->count();

        $pendingTestimonials = Testimonial::where(
            'is_approved',
            false
        )->count();

        /*
        |--------------------------------------------------------------------------
        | RECENT TESTIMONIALS
        |--------------------------------------------------------------------------
        */

        $recentTestimonials = Testimonial::query()
            ->latest()
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CONTACT MESSAGES STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalContactMessages = ContactMessage::count();

        $newContactMessages = ContactMessage::where(
            'status',
            'new'
        )->count();

        $totalQuoteRequests = QuoteRequest::count();

        $newQuoteRequests = QuoteRequest::where('status', 'new')->count();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'totalProducts',
            'featuredProducts',
            'totalCategories',
            'totalTestimonials',
            'approvedTestimonials',
            'pendingTestimonials',
            'recentTestimonials',
            'totalContactMessages',
            'newContactMessages',
            'totalQuoteRequests',
            'newQuoteRequests'
        ));
    }
}
