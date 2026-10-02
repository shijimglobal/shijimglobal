<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layouts.admin', function ($view): void {
            $administrator = auth()->user();

            $view->with([
                'unreadMessagesTotal' => ContactMessage::unread()->count(),
                'unreadNotificationsTotal' => $administrator->unreadNotifications()->count(),
                'recentNotifications' => $administrator->notifications()->limit(8)->get(),
            ]);
        });
    }
}
