<?php

use App\Support\SiteContent;

test('knowledge page is reachable', function () {
    $this->get(route('articles.index'))
        ->assertOk()
        ->assertSee('Нэг минутад ойлгоё')
        ->assertSee('id="contact"', false);
});

test('pages that duplicated the home page no longer exist', function (string $url) {
    $this->get($url)->assertNotFound();
})->with(['/uilchilgee', '/davuu-tal', '/ajlyn-yavts', '/tugeemel-asuult']);

test('home page contains every section and the full faq', function () {
    $response = $this->get(route('home'))->assertOk();

    foreach (['id="services"', 'id="why-us"', 'id="process"', 'id="knowledge"', 'id="faq"', 'id="contact"'] as $section) {
        $response->assertSee($section, false);
    }

    foreach (SiteContent::faqs() as $faq) {
        $response->assertSee($faq['question']);
    }
});

test('header has no menu links', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('data-nav-link', false);
});

test('each service has its own page with includes, faq and a preselected contact form', function () {
    foreach (SiteContent::services() as $service) {
        $this->get($service['url'])
            ->assertOk()
            ->assertSee('<h1', false)
            ->assertSee($service['title'])
            ->assertSee($service['includes'][0]['title'])
            ->assertSee($service['faqs'][0]['question'])
            ->assertSee('value="'.$service['contact_service'].'" data-select-option', false)
            ->assertSee('<title>'.e($service['seo_title']).' | Шижим Глобал</title>', false);
    }
});

test('service page selects its own service in the contact form', function () {
    $html = $this->get(route('services.show', 'server-rental'))->getContent();

    preg_match('#<option value="Server rental"[^>]*>#', $html, $option);

    expect($option[0])->toContain('selected');
});

test('each article renders all of its infographic blocks', function () {
    foreach (SiteContent::articles() as $article) {
        $response = $this->get($article['url'])->assertOk()->assertSee($article['title']);

        foreach ($article['blocks'] as $block) {
            $response->assertSee($block['title'] ?? $block['headline']);
        }
    }
});

test('old mongolian addresses redirect permanently to the english ones', function (string $oldUrl, string $newUrl) {
    $this->get($oldUrl)->assertStatus(301)->assertRedirect($newUrl);
})->with([
    ['/uilchilgee/server-tohirgoo', '/services/server-setup'],
    ['/uilchilgee/veb-sait-hiih', '/services/website-development'],
    ['/uilchilgee/onlain-delguur', '/services/e-commerce'],
    ['/medleg', '/knowledge'],
    ['/medleg/qpay-holboh', '/knowledge/qpay-integration'],
]);

test('unknown old addresses return 404', function () {
    $this->get('/uilchilgee/unknown')->assertNotFound();
    $this->get('/medleg/unknown')->assertNotFound();
});

test('unknown service and article slugs return 404', function () {
    $this->get(route('services.show', 'unknown'))->assertNotFound();
    $this->get(route('articles.show', 'unknown'))->assertNotFound();
});

test('article pages describe themselves as articles for search engines', function () {
    $html = $this->get(route('articles.show', 'qpay-integration'))->assertOk()->getContent();

    preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $html, $matches);
    $types = collect(json_decode($matches[1], true)['@graph'])->pluck('@type')->all();

    expect($types)->toContain('Article', 'BreadcrumbList')
        ->and($html)->toContain('<meta property="og:type" content="article">');
});

test('home page exposes faq structured data', function () {
    $html = $this->get(route('home'))->assertOk()->getContent();

    preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $html, $matches);
    $faqPage = collect(json_decode($matches[1], true)['@graph'])->firstWhere('@type', 'FAQPage');

    expect($faqPage['mainEntity'])->toHaveCount(count(SiteContent::faqs()));
});

test('pages are available in english', function () {
    $this->withSession(['locale' => 'en'])
        ->get(route('services.show', 'website-development'))
        ->assertOk()
        ->assertSee('What is included')
        ->assertSee('Unique design');
});

test('contact form returns to the page it was sent from', function () {
    $this->from(route('services.show', 'online-payments'))
        ->post(route('contact.store'), [
            'name' => 'Бат',
            'phone' => '99112233',
            'service' => 'Online payments',
            'message' => 'QPay холбуулах хүсэлтэй.',
        ])
        ->assertRedirect(route('services.show', 'online-payments').'#contact');
});

test('contact form never redirects to another site', function () {
    $this->withHeader('referer', 'https://evil.example/phish')
        ->post(route('contact.store'), [])
        ->assertRedirect(route('home').'#contact');
});

test('sitemap lists every service and article page', function () {
    $response = $this->get(route('sitemap'))->assertOk();

    foreach ([...SiteContent::services()->pluck('url'), ...SiteContent::articles()->pluck('url'), route('articles.index')] as $url) {
        $response->assertSee('<loc>'.$url.'</loc>', false);
    }
});
