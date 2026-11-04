<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        if (!in_array(
            $status,
            ['all', 'new', 'read', 'replied'],
            true
        )) {
            $status = 'all';
        }

        $search = trim((string) $request->query('search', ''));

        $messages = ContactMessage::query()
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => ContactMessage::count(),
            'new' => ContactMessage::where('status', 'new')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'replied' => ContactMessage::where('status', 'replied')->count(),
        ];

        return view(
            'admin.contact-messages.index',
            compact('messages', 'stats', 'status', 'search')
        );
    }

    public function show(ContactMessage $contactMessage)
    {
        if ($contactMessage->status === 'new') {
            $contactMessage->update([
                'status' => 'read',
            ]);
        }

        return view(
            'admin.contact-messages.show',
            compact('contactMessage')
        );
    }

    public function updateStatus(
        Request $request,
        ContactMessage $contactMessage
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in(['new', 'read', 'replied']),
            ],
        ]);

        $contactMessage->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Message status updated successfully.'
        );
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with(
                'success',
                'Contact message deleted successfully.'
            );
    }
}
