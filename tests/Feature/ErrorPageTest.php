<?php

use App\Models\User;

test('unknown page shows the branded 404 page', function () {
    $this->get('/this-page-does-not-exist')
        ->assertNotFound()
        ->assertSee('Хуудас олдсонгүй')
        ->assertSee('assets/logo/horiz_color.png', false);
});

test('missing admin message shows the 404 page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.messages.show', 999))
        ->assertNotFound()
        ->assertSee('Хуудас олдсонгүй');
});

test('server error page is branded', function () {
    $this->view('errors.500')
        ->assertSee('500')
        ->assertSee('Алдаа гарлаа');
});

test('maintenance page is branded', function () {
    $this->view('errors.503')
        ->assertSee('503')
        ->assertSee('Засвар үйлчилгээ хийгдэж байна');
});
