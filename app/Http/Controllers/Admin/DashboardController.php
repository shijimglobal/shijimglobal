<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the administration overview.
     */
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'totalMessagesCount' => ContactMessage::count(),
            'unreadMessagesCount' => ContactMessage::unread()->count(),
            'todayMessagesCount' => ContactMessage::whereDate('created_at', today())->count(),
            'weekMessagesCount' => ContactMessage::where('created_at', '>=', now()->subDays(7))->count(),
            'messagesPerService' => ContactMessage::query()
                ->selectRaw('service, count(*) as total')
                ->groupBy('service')
                ->orderByDesc('total')
                ->pluck('total', 'service'),
            'latestMessages' => ContactMessage::latest()->limit(5)->get(),
        ]);
    }
}
