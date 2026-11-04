<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | HOMEPAGE CATEGORIES
        |--------------------------------------------------------------------------
        | Show maximum 4 active categories.
        */

        $homeCategories = Category::query()
            ->where('status', true)
            ->whereHas('products', function ($query) {
                $query->where('status', true);
            })
            ->withCount([
                'products as active_products_count' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderBy('id')
            ->take(4)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | FEATURED PRODUCTS
        |--------------------------------------------------------------------------
        | Only active products from active categories.
        */

        $featuredProducts = Product::query()
            ->with('category')
            ->where('featured', true)
            ->where('status', true)
            ->whereHas('category', function ($query) {
                $query->where('status', true);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('pages.home', compact(
            'homeCategories',
            'featuredProducts'
        ));
    }
}
