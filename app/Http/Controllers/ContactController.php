<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Throwable;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:20'],

            'subject' => [
                'required',
                Rule::in([
                    'Product Enquiry',
                    'Interior Décor Consultation',
                    'Custom Décor',
                    'Project Collaboration',
                    'General Enquiry',
                ]),
            ],

            'message' => ['required', 'string', 'max:3000'],

            'company_website' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        // Honeypot spam protection
        if ($request->filled('company_website')) {
            return back()->with(
                'contact_success',
                'Thank you for your enquiry.'
            );
        }

        // Save customer inquiry
        try {
            ContactMessage::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'status' => ContactMessage::STATUS_NEW,
            ]);

        } catch (Throwable $exception) {

            report($exception);

            return back()
                ->withInput()
                ->withErrors([
                    'form' => 'We could not save your message right now. Please try again later.',
                ]);
        }

        // Send notification email
        try {
            Mail::send(
                'emails.contact-enquiry',
                ['enquiry' => $validated],
                function ($mail) use ($validated) {

                    $mail->to('softallure.decor@gmail.com')
                        ->replyTo(
                            $validated['email'],
                            $validated['name']
                        )
                        ->subject(
                            'Soft Allure Décor Enquiry: ' .
                            $validated['subject']
                        );
                }
            );

        } catch (Throwable $exception) {

            // Inquiry is already saved.
            // Log email failure without losing the inquiry.
            report($exception);
        }

        return redirect()
            ->route('contact')
            ->with(
                'contact_success',
                'Thank you! Your enquiry has been received successfully.'
            );
    }
}
