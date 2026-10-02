<?php

test('home page is shown in Mongolian by default', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Илүү их боломж')
        ->assertSee('lang="mn"', false);
});

test('visitor can switch the site to English', function () {
    $this->from(route('home'))
        ->get(route('locale.switch', 'en'))
        ->assertRedirect(route('home'))
        ->assertSessionHas('locale', 'en');

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('More opportunities')
        ->assertSee('lang="en"', false);
});

test('unsupported locale is rejected', function () {
    $this->get(route('locale.switch', 'fr'))
        ->assertNotFound()
        ->assertSessionMissing('locale');
});

test('validation messages are translated to Mongolian', function () {
    $this->post(route('contact.store'), [])
        ->assertSessionHasErrors(['name' => 'нэр талбарыг заавал бөглөнө үү.']);
});
