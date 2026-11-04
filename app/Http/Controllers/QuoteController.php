<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class QuoteController extends Controller
{
    public function submit(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Honeypot Protection
        |--------------------------------------------------------------------------
        */

        if ($request->filled('website')) {
            return redirect()
                ->route('get-a-quote')
                ->with(
                    'quote_success',
                    'Thank you for your enquiry.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Customer Details
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
            ],

            'city' => [
                'nullable',
                'string',
                'max:100',
            ],

            'category' => [
                'required',
                Rule::in([
                    'Curtains & Blinds',
                    'Wall Décor',
                    'Upholstery',
                    'Home Furnishings',
                    'Custom Décor',
                    'Multiple Categories',
                    'Other',
                ]),
            ],

            'quantity' => [
                'nullable',
                'integer',
                'min:1',
                'max:100000',
            ],

            'budget' => [
                'nullable',
                Rule::in([
                    'Below ₹25,000',
                    '₹25,000 - ₹50,000',
                    '₹50,000 - ₹1,00,000',
                    '₹1,00,000 - ₹3,00,000',
                    'Above ₹3,00,000',
                    'Not Decided',
                ]),
            ],

            'timeline' => [
                'nullable',
                Rule::in([
                    'As Soon As Possible',
                    'Within 1 Month',
                    'Within 1-3 Months',
                    'After 3 Months',
                    'Just Exploring',
                ]),
            ],

            'message' => [
                'required',
                'string',
                'max:3000',
            ],

            'products_json' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'attachment' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Selected Products
        |--------------------------------------------------------------------------
        */

        $selectedProducts = [];

        if (!empty($validated['products_json'])) {
            $submitted = json_decode(
                $validated['products_json'],
                true
            );

            if (
                json_last_error() !== JSON_ERROR_NONE ||
                !is_array($submitted) ||
                !array_is_list($submitted) ||
                count($submitted) > 30
            ) {
                throw ValidationException::withMessages([
                    'products_json' =>
                        'Invalid product selection.',
                ]);
            }

            $requested = [];

            foreach ($submitted as $item) {
                if (
                    !is_array($item) ||
                    !isset($item['id'], $item['quantity']) ||
                    !filter_var(
                        $item['id'],
                        FILTER_VALIDATE_INT,
                        ['options' => [
                            'min_range' => 1,
                        ]]
                    ) ||
                    !filter_var(
                        $item['quantity'],
                        FILTER_VALIDATE_INT,
                        ['options' => [
                            'min_range' => 1,
                            'max_range' => 100000,
                        ]]
                    )
                ) {
                    throw ValidationException::withMessages([
                        'products_json' =>
                            'Invalid product or quantity.',
                    ]);
                }

                $id = (int) $item['id'];

                if (isset($requested[$id])) {
                    throw ValidationException::withMessages([
                        'products_json' =>
                            'Duplicate products found.',
                    ]);
                }

                $requested[$id] = (int) $item['quantity'];
            }

            /*
            |--------------------------------------------------------------------------
            | Verify Products Against Database
            |--------------------------------------------------------------------------
            */

            if (!empty($requested)) {
                $products = Product::query()
                    ->with('category')
                    ->where('status', true)
                    ->whereIn(
                        'id',
                        array_keys($requested)
                    )
                    ->get()
                    ->keyBy('id');

                if (
                    $products->count() !==
                    count($requested)
                ) {
                    throw ValidationException::withMessages([
                        'products_json' =>
                            'One or more selected products are unavailable.',
                    ]);
                }

                foreach ($requested as $id => $quantity) {
                    $product = $products->get($id);

                    $selectedProducts[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'category' =>
                            $product->category?->name,
                        'quantity' => $quantity,
                    ];
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Store Attachment And Enquiry
        |--------------------------------------------------------------------------
        */

        $attachment = $request->file('attachment');

        $attachmentPath = null;
        $attachmentName = null;

        try {
            if ($attachment) {
                $attachmentPath = $attachment->store(
                    'quote-attachments',
                    'local'
                );

                if ($attachmentPath === false) {
                    throw new \RuntimeException(
                        'Unable to store the quote attachment.'
                    );
                }

                $attachmentName =
                    $attachment->getClientOriginalName();
            }

            QuoteRequest::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],

                'city' =>
                    $validated['city'] ?? null,

                'category' =>
                    $validated['category'],

                'quantity' =>
                    $validated['quantity'] ?? null,

                'budget' =>
                    $validated['budget'] ?? null,

                'timeline' =>
                    $validated['timeline'] ?? null,

                'message' =>
                    $validated['message'],

                'products' =>
                    $selectedProducts ?: null,

                'attachment_path' =>
                    $attachmentPath,

                'attachment_name' =>
                    $attachmentName,

                'status' =>
                    QuoteRequest::STATUS_NEW,
            ]);

        } catch (Throwable $exception) {
            report($exception);

            if ($attachmentPath) {
                Storage::disk('local')
                    ->delete($attachmentPath);
            }

            return back()
                ->withInput()
                ->withErrors([
                    'form' =>
                        'Unable to save your request. Please try again later.',
                ]);
        }

        
/*
|--------------------------------------------------------------------------
| Prepare Email Content
|--------------------------------------------------------------------------
*/

$emailData = $validated;

// Pass verified products to the email template.
$emailData['selected_products'] = $selectedProducts;

// Keep the original customer message unchanged.
$emailData['message'] = $validated['message'];


        /*
        |--------------------------------------------------------------------------
        | Send Email To Admin
        |--------------------------------------------------------------------------
        */

        try {
            Mail::send(
                'emails.quote-request',
                [
                    'quote' => $emailData,
                ],
                function ($mail) use (
                    $validated,
                    $attachmentPath,
                    $attachmentName
                ) {
                    $mail->to(
                        'softallure.decor@gmail.com'
                    );

                    $mail->replyTo(
                        $validated['email'],
                        $validated['name']
                    );

                    $mail->subject(
                        'New Quote Request - '
                        . $validated['category']
                    );

                    if (
                        $attachmentPath &&
                        Storage::disk('local')
                            ->exists($attachmentPath)
                    ) {
                        $mail->attach(
                            Storage::disk('local')
                                ->path($attachmentPath),
                            [
                                'as' =>
                                    $attachmentName
                                    ?: 'attachment',

                                'mime' =>
                                    Storage::disk('local')
                                        ->mimeType(
                                            $attachmentPath
                                        )
                                    ?: 'application/octet-stream',
                            ]
                        );
                    }
                }
            );

        } catch (Throwable $exception) {
            // Enquiry remains saved in database.
            report($exception);
        }

        /*
        |--------------------------------------------------------------------------
        | Success Response
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('get-a-quote')
            ->with(
                'quote_success',
                'Thank you! Your quote request has been received successfully.'
            );
    }
}
