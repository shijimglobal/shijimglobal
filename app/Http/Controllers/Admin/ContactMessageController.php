<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    /**
     * List contact messages with optional search and filters.
     */
    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::in(['unread', 'read'])],
            'service' => ['nullable', Rule::in(StoreContactRequest::SERVICES)],
        ]);

        $messages = ContactMessage::query()
            ->when($filters['search'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('message', 'like', "%{$search}%");
                });
            })
            ->when(($filters['status'] ?? null) === 'unread', fn ($query) => $query->whereNull('read_at'))
            ->when(($filters['status'] ?? null) === 'read', fn ($query) => $query->whereNotNull('read_at'))
            ->when($filters['service'] ?? null, fn ($query, string $service) => $query->where('service', $service))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.messages.index', [
            'messages' => $messages,
            'filters' => $filters,
        ]);
    }

    /**
     * Show a single message and mark it, and its notifications, as read.
     */
    public function show(Request $request, ContactMessage $message): View
    {
        if (! $message->isRead()) {
            $message->update(['read_at' => now()]);
        }

        $request->user()->unreadNotifications
            ->filter(fn ($notification): bool => ($notification->data['contact_message_id'] ?? null) === $message->id)
            ->markAsRead();

        return view('admin.messages.show', ['message' => $message]);
    }

    /**
     * Mark a message as unread so it is highlighted again.
     */
    public function markUnread(ContactMessage $message): RedirectResponse
    {
        $message->update(['read_at' => null]);

        return redirect()
            ->route('admin.messages.index')
            ->with('status', __('Message marked as unread.'));
    }

    /**
     * Delete a message permanently.
     */
    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('status', __('Message deleted.'));
    }
}
