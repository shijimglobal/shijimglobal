<?php

test('home page title and description cover the common spellings people search with', function () {
    $html = $this->get(route('home'))->assertOk()->getContent();

    preg_match('#<title>(.*?)</title>#s', $html, $title);
    preg_match('#<meta name="description" content="([^"]*)">#', $html, $description);

    expect($title[1])->toBe('Вэб сайт хийх үйлчилгээ | Веб сайт, онлайн дэлгүүр, сервер түрээс | Шижим Глобал')
        ->and($description[1])->toContain('Вэб сайт хийх үйлчилгээ', 'Веб сайт', 'Website hiih', config('company.phone'))
        ->and(mb_strlen(html_entity_decode($description[1])))->toBeLessThanOrEqual(160);
});

test('home page has a single h1 containing the main keyword', function () {
    $html = $this->get(route('home'))->assertOk()->getContent();

    expect(substr_count($html, '<h1'))->toBe(1);

    preg_match('#<h1[^>]*>(.*?)</h1>#s', $html, $heading);

    expect(strip_tags($heading[1]))->toContain('Вэб сайт хийх үйлчилгээ');
});

test('home page includes organization structured data', function () {
    $html = $this->get(route('home'))->assertOk()->getContent();

    preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $html, $matches);
    $structuredData = json_decode($matches[1] ?? '', true);

    expect($structuredData)->not->toBeNull();

    $types = collect($structuredData['@graph'])->pluck('@type')->all();
    $organization = collect($structuredData['@graph'])->firstWhere('@type', 'Organization');
    $service = collect($structuredData['@graph'])->firstWhere('@type', 'ProfessionalService');

    expect($types)->toBe(['Organization', 'WebSite', 'ProfessionalService'])
        ->and($organization['name'])->toBe('Шижим Глобал ХХК')
        ->and($organization['email'])->toBe(config('company.email'))
        ->and($organization['sameAs'])->toBe([config('company.facebook')])
        ->and(collect($service['hasOfferCatalog']['itemListElement'])->pluck('itemOffered.name')->all())
        ->toContain('Танилцуулга веб сайт', 'Сервер түрээс');
});

test('google site verification meta tag is rendered when configured', function () {
    config(['services.google.site_verification' => 'verification-token']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<meta name="google-site-verification" content="verification-token">', false);
});

test('favicons meet google search requirements', function () {
    expect(filesize(public_path('favicon.ico')))->toBeGreaterThan(0);

    foreach ([48, 96, 192] as $size) {
        expect(getimagesize(public_path("assets/ico/favicon-{$size}x{$size}.png")))->toMatchArray([0 => $size, 1 => $size]);
    }

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<link rel="icon" type="image/png" sizes="48x48" href="'.asset('assets/ico/favicon-48x48.png').'">', false)
        ->assertSee('<link rel="icon" href="'.asset('favicon.ico').'" sizes="any">', false);
});

test('www requests are permanently redirected to the bare domain', function () {
    config(['app.url' => 'https://shijimglobal.com']);

    $this->get('http://www.shijimglobal.com/privacy-policy?ref=google')
        ->assertStatus(301)
        ->assertRedirect('https://shijimglobal.com/privacy-policy?ref=google');
});

test('bare domain requests are not redirected', function () {
    config(['app.url' => 'https://shijimglobal.com']);

    $this->get('https://shijimglobal.com/')->assertOk();
});

test('www of a foreign domain is not redirected', function () {
    config(['app.url' => 'https://shijimglobal.com']);

    $this->get('https://www.example.com/')->assertOk();
});

test('form submissions on www are not redirected so their data is kept', function () {
    config(['app.url' => 'https://shijimglobal.com']);

    $this->post('https://www.shijimglobal.com/contact', [])
        ->assertRedirect()
        ->assertSessionHasErrors('name');
});

test('sitemap lists the home page', function () {
    $this->get('/sitemap.xml')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee('<loc>'.route('home').'</loc>', false);
});

test('robots file points to the sitemap and hides private areas', function () {
    $robots = file_get_contents(public_path('robots.txt'));

    expect($robots)->toContain('Disallow: /modify')
        ->toContain('Disallow: /login')
        ->toContain('Sitemap: https://shijimglobal.com/sitemap.xml');
});
