<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ALL PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $categorySlug = trim((string) $request->query('category', ''));

        $sort = $this->validSort(
            $request->query('sort', 'newest')
        );

        $perPage = $this->validPerPage(
            $request->query('per_page', 12)
        );

        $categories = Category::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $query = Product::query()
            ->with('category')
            ->withCount('approvedReviews')
            ->withAvg('approvedReviews', 'rating')
            ->where('status', true)
            ->whereHas('category', function (Builder $q) {
                $q->where('status', true);
            });

        if ($search !== '') {
            $query->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere(
                        'short_description',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhereHas(
                        'category',
                        function (Builder $categoryQuery) use ($search) {
                            $categoryQuery->where(
                                'name',
                                'like',
                                '%' . $search . '%'
                            );
                        }
                    );
            });
        }

        if ($categorySlug !== '') {
            $query->whereHas(
                'category',
                function (Builder $q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                }
            );
        }

        $this->applySorting($query, $sort);

        $products = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.products', compact(
            'products',
            'categories',
            'search',
            'categorySlug',
            'sort',
            'perPage'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY PRODUCTS
    |--------------------------------------------------------------------------
    */
    public function category(Request $request, string $slug)
    {
        $category = Category::query()
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        $categories = Category::query()
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $sort = $this->validSort(
            $request->query('sort', 'newest')
        );

        $perPage = $this->validPerPage(
            $request->query('per_page', 12)
        );

        $query = Product::query()
            ->with('category')
            ->withCount('approvedReviews')
            ->withAvg('approvedReviews', 'rating')
            ->where('category_id', $category->id)
            ->where('status', true);

        $this->applySorting($query, $sort);

        $products = $query
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.product-category', compact(
            'category',
            'categories',
            'products',
            'sort',
            'perPage'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUCT DETAILS
    |--------------------------------------------------------------------------
    */
    public function show(string $slug)
    {
        $product = Product::query()
            ->with(['category', 'images'])
            ->withCount('approvedReviews')
            ->withAvg('approvedReviews', 'rating')
            ->where('slug', $slug)
            ->where('status', true)
            ->whereHas('category', function (Builder $q) {
                $q->where('status', true);
            })
            ->firstOrFail();

        /*
        | Related products from the same active category.
        */
        $relatedProducts = Product::query()
            ->with('category')
            ->withCount('approvedReviews')
            ->withAvg('approvedReviews', 'rating')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->whereHas('category', function (Builder $q) {
                $q->where('status', true);
            })
            ->latest()
            ->limit(4)
            ->get();

        /*
        | Only approved customer reviews are public.
        */
        $reviews = $product->approvedReviews()
            ->latest()
            ->paginate(5, ['*'], 'reviews_page')
            ->withQueryString();

        $reviewCount = $product->rating_count;

        $averageRating = (float) (
            $product->approved_reviews_avg_rating ?? 0
        );

        return view('pages.product-details', compact(
            'product',
            'relatedProducts',
            'reviews',
            'reviewCount',
            'averageRating'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | VALID SORT
    |--------------------------------------------------------------------------
    */
    private function validSort($sort): string
    {
        $allowed = [
            'newest',
            'oldest',
            'price_low',
            'price_high',
            'name',
        ];

        return is_string($sort) &&
            in_array($sort, $allowed, true)
                ? $sort
                : 'newest';
    }

    /*
    |--------------------------------------------------------------------------
    | VALID PAGINATION
    |--------------------------------------------------------------------------
    */
    private function validPerPage($perPage): int
    {
        $perPage = filter_var(
            $perPage,
            FILTER_VALIDATE_INT
        );

        return in_array($perPage, [8, 12, 16, 24], true)
            ? $perPage
            : 12;
    }

    /*
    |--------------------------------------------------------------------------
    | APPLY SORTING
    |--------------------------------------------------------------------------
    */
    private function applySorting(
        Builder $query,
        string $sort
    ): void {
        switch ($sort) {
            case 'oldest':
                $query
                    ->orderBy('created_at')
                    ->orderBy('id');
                break;

            case 'price_low':
                $query
                    ->orderByRaw('price IS NULL')
                    ->orderBy('price')
                    ->orderBy('id');
                break;

            case 'price_high':
                $query
                    ->orderByRaw('price IS NULL')
                    ->orderByDesc('price')
                    ->orderBy('id');
                break;

            case 'name':
                $query
                    ->orderBy('name')
                    ->orderBy('id');
                break;

            default:
                $query
                    ->latest()
                    ->orderByDesc('id');
                break;
        }
    }
}
