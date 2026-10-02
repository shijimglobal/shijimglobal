<?php

test('home page renders company services', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Илүү их боломж')
        ->assertSee('Онлайн төлбөр тооцоо')
        ->assertSee('Сервер түрээс');
});

test('home page links to the configured messenger chat', function () {
    config(['company.messenger' => 'https://m.me/example-page']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('href="https://m.me/example-page"', false);
});

test('messenger button is hidden when no chat link is configured', function () {
    config(['company.messenger' => null]);

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('tabler--brand-messenger', false);
});

test('valid contact request is stored as an unread message', function () {
    $this->post(route('contact.store'), [
        'name' => 'Бат',
        'phone' => '99112233',
        'email' => 'bat@example.com',
        'service' => 'E-commerce',
        'message' => 'Онлайн дэлгүүр хийлгэх хүсэлтэй байна.',
    ])
        ->assertRedirect(route('home').'#contact')
        ->assertSessionHas('status');

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Бат',
        'phone' => '99112233',
        'service' => 'E-commerce',
        'read_at' => null,
    ]);
});

test('contact request requires name, phone, service and message', function () {
    $this->post(route('contact.store'), [])
        ->assertRedirect(route('home').'#contact')
        ->assertSessionHasErrors(['name', 'phone', 'service', 'message']);
});

test('contact request rejects unknown service', function () {
    $this->post(route('contact.store'), [
        'name' => 'Бат',
        'phone' => '99112233',
        'service' => 'Unknown',
        'message' => 'Сайн байна уу',
    ])->assertSessionHasErrors('service');
});
