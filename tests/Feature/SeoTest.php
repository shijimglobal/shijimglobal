<?php

test('home page title contains the main search keywords', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<title>Шижим Глобал ХХК — Веб сайт хийх, онлайн төлбөр, сервер түрээс</title>', false)
        ->assertSee('<meta name="description" content="Танилцуулга веб сайт, онлайн дэлгүүр хийх', false);
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
