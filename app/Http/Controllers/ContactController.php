<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\NewContactMessageNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    /**
     * Store a contact request submitted from the website and notify administrators.
     */
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $contactMessage = ContactMessage::create($request->validated());

        Notification::send(User::all(), new NewContactMessageNotification($contactMessage));

        return redirect()
            ->to(route('home').'#contact')
            ->with('status', __('Thank you! We received your request and will contact you shortly.'));
    }
}
