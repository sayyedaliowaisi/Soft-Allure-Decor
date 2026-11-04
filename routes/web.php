<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProductReviewController;


use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\QuoteRequestController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\Admin\ProductReviewController as AdminProductReviewController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [
    HomeController::class,
    'index'
])->name('home');

Route::view('/about', 'pages.about')
    ->name('about');

Route::get('/products', [ProductPageController::class, 'index'])
    ->name('products');

Route::get('/products/category/{slug}', [ProductPageController::class, 'category'])
    ->name('products.category');

Route::get('/products/{slug}', [ProductPageController::class, 'show'])
    ->name('products.show');


    Route::post(
    '/products/{product:slug}/reviews',
    [ProductReviewController::class, 'store']
)
    ->middleware('throttle:5,10')
    ->name('products.reviews.store');

Route::view('/gallery', 'pages.gallery')
    ->name('gallery');

Route::view('/contact', 'pages.contact')
    ->name('contact');

Route::post('/contact', [
    ContactController::class,
    'submit'
])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

/*
|--------------------------------------------------------------------------
| GET A QUOTE
|--------------------------------------------------------------------------
*/

Route::view('/get-a-quote', 'pages.get-a-quote')
    ->name('get-a-quote');

Route::post('/get-a-quote', [
    QuoteController::class,
    'submit'
])
    ->middleware('throttle:5,1')
    ->name('get-a-quote.submit');

/*
|--------------------------------------------------------------------------
| PUBLIC TESTIMONIALS
|--------------------------------------------------------------------------
*/

Route::get('/testimonials', [
    TestimonialController::class,
    'index'
])->name('testimonials');

Route::post('/testimonials', [
    TestimonialController::class,
    'store'
])
    ->middleware('throttle:5,1')
    ->name('testimonials.store');

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION
|--------------------------------------------------------------------------
*/

// Admin login - guests only
Route::middleware('guest')->group(function () {

    Route::get('/admin/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/admin/login', [
        AuthController::class,
        'login'
    ])
        ->middleware('throttle:5,1')
        ->name('admin.login.submit');

});

// Admin logout
Route::post('/admin/logout', [
    AuthController::class,
    'logout'
])
    ->middleware('auth')
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ADMIN ROUTES
|--------------------------------------------------------------------------
|
| auth  = user must be logged in
| admin = user must have is_admin = true
|
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [
            DashboardController::class,
            'index'
        ])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | PRODUCTS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'products',
            ProductController::class
        );

        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'categories',
            CategoryController::class
        );

        /*
        |--------------------------------------------------------------------------
        | TESTIMONIALS
        |--------------------------------------------------------------------------
        */

        Route::get('/testimonials', [
            AdminTestimonialController::class,
            'index'
        ])->name('testimonials.index');

        Route::patch('/testimonials/{testimonial}/approve', [
            AdminTestimonialController::class,
            'approve'
        ])->name('testimonials.approve');

        Route::patch('/testimonials/{testimonial}/unapprove', [
            AdminTestimonialController::class,
            'unapprove'
        ])->name('testimonials.unapprove');

        Route::delete('/testimonials/{testimonial}', [
            AdminTestimonialController::class,
            'destroy'
        ])->name('testimonials.destroy');


        /*
|--------------------------------------------------------------------------
| CONTACT MESSAGES
|--------------------------------------------------------------------------
*/

Route::get('/contact-messages', [
    ContactMessageController::class,
    'index'
])->name('contact-messages.index');

Route::get('/contact-messages/{contactMessage}', [
    ContactMessageController::class,
    'show'
])->name('contact-messages.show');

Route::patch('/contact-messages/{contactMessage}/status', [
    ContactMessageController::class,
    'updateStatus'
])->name('contact-messages.status');

Route::delete('/contact-messages/{contactMessage}', [
    ContactMessageController::class,
    'destroy'
])->name('contact-messages.destroy');


/*
|--------------------------------------------------------------------------
| QUOTE REQUESTS
|--------------------------------------------------------------------------
*/

Route::get('/quote-requests', [
    QuoteRequestController::class,
    'index'
])->name('quote-requests.index');

Route::get('/quote-requests/{quoteRequest}', [
    QuoteRequestController::class,
    'show'
])->name('quote-requests.show');

Route::patch('/quote-requests/{quoteRequest}/status', [
    QuoteRequestController::class,
    'updateStatus'
])->name('quote-requests.status');

Route::get('/quote-requests/{quoteRequest}/download', [
    QuoteRequestController::class,
    'download'
])->name('quote-requests.download');

Route::delete('/quote-requests/{quoteRequest}', [
    QuoteRequestController::class,
    'destroy'
])->name('quote-requests.destroy');


Route::get(
    '/product-reviews',
    [AdminProductReviewController::class, 'index']
)->name('product-reviews.index');

Route::patch(
    '/product-reviews/{review}/approve',
    [AdminProductReviewController::class, 'approve']
)->name('product-reviews.approve');

Route::patch(
    '/product-reviews/{review}/reject',
    [AdminProductReviewController::class, 'reject']
)->name('product-reviews.reject');

Route::delete(
    '/product-reviews/{review}',
    [AdminProductReviewController::class, 'destroy']
)->name('product-reviews.destroy');

    });
