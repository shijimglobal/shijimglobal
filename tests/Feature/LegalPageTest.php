<?php

test('legal pages are reachable at their public urls', function (string $url, string $mongolianTitle) {
    $this->get($url)
        ->assertOk()
        ->assertSee('<h1', false)
        ->assertSee($mongolianTitle)
        ->assertSee(config('company.email'));
})->with([
    ['/privacy-policy', 'Нууцлалын бодлого'],
    ['/terms', 'Үйлчилгээний нөхцөл'],
    ['/data-deletion', 'Мэдээлэл устгах'],
]);

test('legal pages are shown in english when english is selected', function () {
    $this->withSession(['locale' => 'en'])
        ->get(route('legal.privacy'))
        ->assertOk()
        ->assertSee('Privacy Policy')
        ->assertSee('Information we collect');
});

test('section links on legal pages point back to the home page', function () {
    $this->get(route('legal.terms'))
        ->assertOk()
        ->assertSee('href="'.route('home').'#services"', false)
        ->assertSee('href="'.route('home').'#contact"', false);
});

test('footer links to every legal page', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('href="'.route('legal.privacy').'"', false)
        ->assertSee('href="'.route('legal.terms').'"', false)
        ->assertSee('href="'.route('legal.data-deletion').'"', false);
});

test('sitemap includes the legal pages', function () {
    $this->get(route('sitemap'))
        ->assertOk()
        ->assertSee('<loc>'.route('legal.privacy').'</loc>', false)
        ->assertSee('<loc>'.route('legal.data-deletion').'</loc>', false);
});
