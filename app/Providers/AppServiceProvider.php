<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        View::composer('components.navbar', function ($view) {
    $navbarCategories = Category::query()
        ->where('status', true)
        ->orderBy('name')
        ->get(['name', 'slug']);

    $view->with('navbarCategories', $navbarCategories);
        });
    }
}
