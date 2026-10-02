<?php

use App\Models\ContactMessage;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

test('dashboard shows message statistics', function () {
    ContactMessage::factory()->count(3)->create();
    ContactMessage::factory()->read()->create(['name' => 'Уншсан Хэрэглэгч']);

    $this->get(route('admin.dashboard'))
        ->assertOk()
        ->assertViewHas('totalMessagesCount', 4)
        ->assertViewHas('unreadMessagesCount', 3)
        ->assertSee('Уншсан Хэрэглэгч');
});

test('messages list shows newest messages', function () {
    ContactMessage::factory()->create(['name' => 'Болд']);

    $this->get(route('admin.messages.index'))
        ->assertOk()
        ->assertSee('Болд');
});

test('messages can be filtered by status', function () {
    ContactMessage::factory()->create(['name' => 'Шинэ Хүсэлт']);
    ContactMessage::factory()->read()->create(['name' => 'Хуучин Хүсэлт']);

    $this->get(route('admin.messages.index', ['status' => 'unread']))
        ->assertOk()
        ->assertSee('Шинэ Хүсэлт')
        ->assertDontSee('Хуучин Хүсэлт');
});

test('messages can be searched by phone number', function () {
    ContactMessage::factory()->create(['name' => 'Олдох', 'phone' => '88001122']);
    ContactMessage::factory()->create(['name' => 'Олдохгүй', 'phone' => '99001122']);

    $this->get(route('admin.messages.index', ['search' => '8800']))
        ->assertOk()
        ->assertSee('Олдох')
        ->assertDontSee('Олдохгүй');
});

test('opening a message marks it as read', function () {
    $message = ContactMessage::factory()->create();

    $this->get(route('admin.messages.show', $message))
        ->assertOk()
        ->assertSee($message->phone);

    expect($message->fresh()->isRead())->toBeTrue();
});

test('message can be marked as unread', function () {
    $message = ContactMessage::factory()->read()->create();

    $this->patch(route('admin.messages.unread', $message))
        ->assertRedirect(route('admin.messages.index'));

    expect($message->fresh()->isRead())->toBeFalse();
});

test('message can be deleted', function () {
    $message = ContactMessage::factory()->create();

    $this->delete(route('admin.messages.destroy', $message))
        ->assertRedirect(route('admin.messages.index'));

    $this->assertModelMissing($message);
});
