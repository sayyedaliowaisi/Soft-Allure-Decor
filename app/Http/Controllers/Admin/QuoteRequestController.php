<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class QuoteRequestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ALL QUOTE REQUESTS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $allowedStatuses = [
            'all',
            QuoteRequest::STATUS_NEW,
            QuoteRequest::STATUS_READ,
            QuoteRequest::STATUS_REPLIED,
        ];

        $status = $request->query('status', 'all');

        if (!is_string($status) ||
            !in_array($status, $allowedStatuses, true)) {
            $status = 'all';
        }

        $searchInput = $request->query('search', '');

        $search = is_string($searchInput)
            ? mb_substr(trim($searchInput), 0, 150)
            : '';

        $quotes = QuoteRequest::query()
            ->when(
                $status !== 'all',
                function ($query) use ($status) {
                    $query->where('status', $status);
                }
            )
            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%")
                            ->orWhere('city', 'like', "%{$search}%")
                            ->orWhere('category', 'like', "%{$search}%");
                    });
                }
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD STATISTICS
        |--------------------------------------------------------------------------
        */

        $stats = [
            'total' => QuoteRequest::count(),

            'new' => QuoteRequest::where(
                'status',
                QuoteRequest::STATUS_NEW
            )->count(),

            'read' => QuoteRequest::where(
                'status',
                QuoteRequest::STATUS_READ
            )->count(),

            'replied' => QuoteRequest::where(
                'status',
                QuoteRequest::STATUS_REPLIED
            )->count(),
        ];

        return view(
            'admin.quote-requests.index',
            compact(
                'quotes',
                'stats',
                'status',
                'search'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | VIEW SINGLE QUOTE REQUEST
    |--------------------------------------------------------------------------
    */

    public function show(QuoteRequest $quoteRequest)
    {
        if (
            $quoteRequest->status ===
            QuoteRequest::STATUS_NEW
        ) {
            $quoteRequest->update([
                'status' => QuoteRequest::STATUS_READ,
            ]);
        }

        return view(
            'admin.quote-requests.show',
            compact('quoteRequest')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE QUOTE STATUS
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        QuoteRequest $quoteRequest
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    QuoteRequest::STATUS_NEW,
                    QuoteRequest::STATUS_READ,
                    QuoteRequest::STATUS_REPLIED,
                ]),
            ],
        ]);

        $quoteRequest->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Quote request status updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD ATTACHMENT
    |--------------------------------------------------------------------------
    */

    public function download(QuoteRequest $quoteRequest)
    {
        $path = $quoteRequest->attachment_path;

        abort_unless(
            $path &&
            Storage::disk('local')->exists($path),
            404
        );

        $originalName = $quoteRequest->attachment_name;

        $downloadName = $originalName
            ? basename(
                str_replace('\\', '/', $originalName)
            )
            : basename($path);

        return Storage::disk('local')->download(
            $path,
            $downloadName
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE QUOTE REQUEST
    |--------------------------------------------------------------------------
    */

    public function destroy(QuoteRequest $quoteRequest)
    {
        $attachmentPath = $quoteRequest->attachment_path;

        // Delete database record first.
        $quoteRequest->delete();

        // Remove attachment from private storage.
        if (
            $attachmentPath &&
            Storage::disk('local')->exists($attachmentPath)
        ) {
            Storage::disk('local')->delete(
                $attachmentPath
            );
        }

        return redirect()
            ->route('admin.quote-requests.index')
            ->with(
                'success',
                'Quote request deleted successfully.'
            );
    }
}
