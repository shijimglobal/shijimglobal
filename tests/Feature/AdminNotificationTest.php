<?php

use App\Models\ContactMessage;
use App\Models\User;
use App\Notifications\NewContactMessageNotification;
use Illuminate\Support\Facades\Notification;

function submitContactForm(): void
{
    test()->post(route('contact.store'), [
        'name' => 'Сараа',
        'phone' => '99112233',
        'service' => 'Server rental',
        'message' => 'Сервер түрээслэх талаар мэдээлэл авмаар байна.',
    ]);
}

test('every administrator is notified about a new contact request', function () {
    Notification::fake();
    $administrators = User::factory()->count(2)->create();

    submitContactForm();

    Notification::assertSentTo(
        $administrators,
        NewContactMessageNotification::class,
        fn (NewContactMessageNotification $notification): bool => $notification->contactMessage->name === 'Сараа',
    );
});

test('notification bell shows the unread notification', function () {
    $administrator = User::factory()->create();
    submitContactForm();

    $this->actingAs($administrator)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertSee('data-notification-count="1"', false)
        ->assertSee('Сараа-аас шинэ хүсэлт');
});

test('poll endpoint returns the unread count and latest notification', function () {
    $administrator = User::factory()->create();
    submitContactForm();

    $this->actingAs($administrator)
        ->getJson(route('admin.notifications.poll'))
        ->assertOk()
        ->assertJsonPath('unread_count', 1)
        ->assertJsonPath('latest.title', 'Сараа-аас шинэ хүсэлт');
});

test('opening a notification marks it read and shows the message', function () {
    $administrator = User::factory()->create();
    submitContactForm();
    $notification = $administrator->unreadNotifications()->first();

    $this->actingAs($administrator)
        ->get(route('admin.notifications.open', $notification->id))
        ->assertRedirect(route('admin.messages.show', ContactMessage::first()));

    expect($notification->fresh()->read())->toBeTrue();
});

test('opening the message also clears its notification', function () {
    $administrator = User::factory()->create();
    submitContactForm();

    $this->actingAs($administrator)->get(route('admin.messages.show', ContactMessage::first()));

    expect($administrator->unreadNotifications()->count())->toBe(0);
});

test('all notifications can be marked as read', function () {
    $administrator = User::factory()->create();
    submitContactForm();
    submitContactForm();

    $this->actingAs($administrator)
        ->post(route('admin.notifications.read-all'))
        ->assertRedirect();

    expect($administrator->unreadNotifications()->count())->toBe(0);
});

test('administrator cannot open another administrators notification', function () {
    $owner = User::factory()->create();
    $otherAdministrator = User::factory()->create();
    submitContactForm();
    $notification = $owner->notifications()->first();

    $this->actingAs($otherAdministrator)
        ->get(route('admin.notifications.open', $notification->id))
        ->assertNotFound();
});
