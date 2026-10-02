<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Return the unread notification count and the newest unread notification for polling.
     */
    public function poll(Request $request): JsonResponse
    {
        $user = $request->user();
        $latestNotification = $user->unreadNotifications()->first();

        return response()->json([
            'unread_count' => $user->unreadNotifications()->count(),
            'latest' => $latestNotification ? [
                'id' => $latestNotification->id,
                'title' => __('New request from :name', ['name' => $latestNotification->data['name']]),
                'body' => __($latestNotification->data['service']).' · '.$latestNotification->data['excerpt'],
                'url' => route('admin.notifications.open', $latestNotification->id),
            ] : null,
        ]);
    }

    /**
     * Mark a notification as read and open the related contact message.
     */
    public function open(Request $request, string $notification): RedirectResponse
    {
        $databaseNotification = $request->user()->notifications()->findOrFail($notification);
        $databaseNotification->markAsRead();

        return redirect()->route('admin.messages.show', $databaseNotification->data['contact_message_id']);
    }

    /**
     * Mark every notification of the current user as read.
     */
    public function markAllRead(Request $request): RedirectResponse
    {
        $request->user()->unreadNotifications->markAsRead();

        return back()->with('status', __('All notifications marked as read.'));
    }
}
