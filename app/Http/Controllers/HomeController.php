<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', true)
            ->where('status', true)
            ->latest()
            ->take(6)
            ->get();

        return view('pages.home', compact('featuredProducts'));
    }
}