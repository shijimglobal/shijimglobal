<?php

use App\Services\FacebookPageService;
use Illuminate\Support\Facades\Http;

function fakeFacebookPage(int $followersCount = 12450): void
{
    Http::fake([
        'graph.facebook.com/*' => Http::response([
            'id' => '123456',
            'name' => 'Shijim Global',
            'about' => 'Илүү их боломж, илүү бага зардал',
            'category' => 'IT Company',
            'link' => 'https://www.facebook.com/shijimglobal',
            'followers_count' => $followersCount,
            'fan_count' => 980,
            'picture' => ['data' => ['url' => 'https://scontent.example/picture.jpg']],
            'cover' => ['source' => 'https://scontent.example/cover.jpg'],
        ]),
    ]);
}

beforeEach(function () {
    config([
        'services.facebook.page_id' => '123456',
        'services.facebook.page_access_token' => 'test-token',
        'services.facebook.graph_version' => 'v23.0',
        'services.facebook.cache_minutes' => 60,
    ]);
});

test('home page shows the facebook page profile', function () {
    fakeFacebookPage();

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Shijim Global')
        ->assertSee('12.5K')
        ->assertSee('href="https://www.facebook.com/shijimglobal"', false)
        ->assertSee('https://scontent.example/cover.jpg', false);
});

test('graph api is called with the page id, fields and access token', function () {
    fakeFacebookPage();

    app(FacebookPageService::class)->profile();

    Http::assertSent(fn ($request): bool => str_starts_with($request->url(), 'https://graph.facebook.com/v23.0/123456')
        && $request['access_token'] === 'test-token'
        && str_contains($request['fields'], 'followers_count'));
});

test('profile is cached between requests', function () {
    fakeFacebookPage();

    $this->get(route('home'));
    $this->get(route('home'));

    Http::assertSentCount(1);
});

test('section is hidden when facebook is not configured', function () {
    config(['services.facebook.page_access_token' => null]);
    Http::fake();

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('id="facebook"', false);

    Http::assertNothingSent();
});

test('last known profile is shown when the api fails', function () {
    fakeFacebookPage(5000);
    $facebookPageService = app(FacebookPageService::class);
    $facebookPageService->profile();
    $facebookPageService->flush();

    Http::fake(['graph.facebook.com/*' => Http::response(['error' => ['message' => 'Invalid token']], 400)]);

    expect($facebookPageService->profile()['followers_count'])->toBe(5000);
});

test('section is hidden when the api fails and nothing was cached', function () {
    Http::fake(['graph.facebook.com/*' => Http::response(['error' => ['message' => 'Invalid token']], 400)]);

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('id="facebook"', false);
});

test('messenger buttons carry a facebook.com inbox link using the page username', function () {
    config(['company.messenger' => 'https://m.me/shijimglobal']);
    fakeFacebookPage();

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('data-desktop-href="https://www.facebook.com/messages/t/shijimglobal"', false);
});

test('messenger buttons carry the messenger app deep link for phones', function () {
    fakeFacebookPage();

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('data-app-href="fb-messenger://user-thread/123456"', false);
});

test('messenger app link requires a numeric page id', function () {
    config(['services.facebook.page_id' => 'shijimglobal']);

    expect(FacebookPageService::messengerAppUrl())->toBeNull();
});

test('desktop messenger link falls back to the page id', function () {
    config(['company.messenger' => null]);

    expect(FacebookPageService::desktopMessengerUrl())->toBe('https://www.facebook.com/messages/t/123456');
});

test('desktop messenger link is empty without username or page id', function () {
    config(['company.messenger' => null, 'services.facebook.page_id' => null]);

    expect(FacebookPageService::desktopMessengerUrl())->toBeNull();
});

test('follower counts are abbreviated', function (int $count, string $expected) {
    expect(FacebookPageService::abbreviate($count))->toBe($expected);
})->with([
    [950, '950'],
    [1000, '1K'],
    [12450, '12.5K'],
    [1250000, '1.3M'],
]);
