<?php

test('home page has open graph tags with a properly sized share image', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<meta property="og:image" content="'.asset('assets/og/og-image.png').'">', false)
        ->assertSee('<meta property="og:image:width" content="1200">', false)
        ->assertSee('<meta property="og:image:height" content="630">', false)
        ->assertSee('<meta property="og:title" content="Шижим Глобал ХХК — Илүү их боломж, илүү бага зардал">', false)
        ->assertSee('<meta name="twitter:card" content="summary_large_image">', false)
        ->assertSee('<meta property="og:locale" content="mn_MN">', false);
});

test('share image and padded icons exist', function () {
    expect(getimagesize(public_path('assets/og/og-image.png')))->toMatchArray([0 => 1200, 1 => 630])
        ->and(public_path('assets/ico/apple-touch-icon-padded.png'))->toBeFile()
        ->and(public_path('assets/ico/icon-512.png'))->toBeFile();
});

test('web manifest points to existing icons', function () {
    $manifest = json_decode(file_get_contents(public_path('assets/ico/site.webmanifest')), true);

    expect($manifest['name'])->toBe('Шижим Глобал');

    foreach ($manifest['icons'] as $icon) {
        expect(public_path(ltrim($icon['src'], '/')))->toBeFile();
    }
});

test('admin pages do not expose open graph tags', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertDontSee('og:image', false);
});
