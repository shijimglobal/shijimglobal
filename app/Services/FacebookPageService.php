<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Illuminate\Support\defer;

class FacebookPageService
{
    /**
     * Cache key holding the fresh page profile.
     */
    public const CACHE_KEY = 'facebook-page.profile';

    /**
     * Cache key holding the last successfully fetched profile, used when the API fails.
     */
    public const LAST_KNOWN_CACHE_KEY = 'facebook-page.profile.last-known';

    /**
     * Cache key that pauses API calls for a short while after a failure.
     */
    public const FAILURE_CACHE_KEY = 'facebook-page.profile.failed';

    /**
     * Cache key that prevents several requests from refreshing the profile at once.
     */
    public const REFRESH_LOCK_CACHE_KEY = 'facebook-page.profile.refreshing';

    /**
     * Page fields requested from the Graph API.
     */
    private const FIELDS = 'name,about,category,link,followers_count,fan_count,picture.width(320).height(320){url},cover{source}';

    /**
     * Determine whether the page id and access token are configured.
     */
    public function isConfigured(): bool
    {
        return filled(config('services.facebook.page_id')) && filled(config('services.facebook.page_access_token'));
    }

    /**
     * Get the cached page profile, refreshing it from the Graph API when it has expired.
     *
     * @return array{name: string, about: ?string, category: ?string, link: string, followers_count: int, fan_count: int, picture_url: ?string, cover_url: ?string}|null
     */
    public function profile(): ?array
    {
        if (! $this->isConfigured()) {
            return null;
        }

        if ($cachedProfile = Cache::get(self::CACHE_KEY)) {
            return $cachedProfile;
        }

        $lastKnownProfile = Cache::get(self::LAST_KNOWN_CACHE_KEY);

        // Serve the previous profile immediately and refresh it after the response is sent,
        // so visitors never wait for the Graph API.
        if ($lastKnownProfile !== null) {
            if (! Cache::has(self::FAILURE_CACHE_KEY) && Cache::add(self::REFRESH_LOCK_CACHE_KEY, true, 60)) {
                defer(fn () => $this->refresh());
            }

            return $lastKnownProfile;
        }

        if (Cache::has(self::FAILURE_CACHE_KEY)) {
            return null;
        }

        return $this->refresh();
    }

    /**
     * Fetch the profile from the Graph API and store it in the cache.
     *
     * @return array{name: string, about: ?string, category: ?string, link: string, followers_count: int, fan_count: int, picture_url: ?string, cover_url: ?string}|null
     */
    public function refresh(): ?array
    {
        $freshProfile = $this->fetch();

        Cache::forget(self::REFRESH_LOCK_CACHE_KEY);

        if ($freshProfile === null) {
            Cache::put(self::FAILURE_CACHE_KEY, true, now()->addMinutes(10));

            return null;
        }

        Cache::put(self::CACHE_KEY, $freshProfile, now()->addMinutes(config('services.facebook.cache_minutes')));
        Cache::forever(self::LAST_KNOWN_CACHE_KEY, $freshProfile);

        return $freshProfile;
    }

    /**
     * Get the facebook.com inbox link for desktop visitors.
     *
     * The m.me short link sends desktop browsers to messenger.com, which has its own
     * login, so desktop visitors are sent to the page conversation on facebook.com instead.
     */
    public static function desktopMessengerUrl(): ?string
    {
        $messengerUsername = trim((string) parse_url((string) config('company.messenger'), PHP_URL_PATH), '/');
        $conversationTarget = filled($messengerUsername) ? $messengerUsername : config('services.facebook.page_id');

        return filled($conversationTarget) ? 'https://www.facebook.com/messages/t/'.$conversationTarget : null;
    }

    /**
     * Get the Messenger app deep link that opens the page conversation on phones.
     */
    public static function messengerAppUrl(): ?string
    {
        $pageId = config('services.facebook.page_id');

        return ctype_digit((string) $pageId) ? 'fb-messenger://user-thread/'.$pageId : null;
    }

    /**
     * Forget the cached profile so the next request fetches fresh data.
     */
    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::FAILURE_CACHE_KEY);
    }

    /**
     * Shorten a follower count for display, e.g. 12400 becomes "12.4K".
     */
    public static function abbreviate(int $count): string
    {
        foreach ([1_000_000_000 => 'B', 1_000_000 => 'M', 1_000 => 'K'] as $threshold => $suffix) {
            if ($count >= $threshold) {
                return rtrim(rtrim(number_format($count / $threshold, 1, '.', ''), '0'), '.').$suffix;
            }
        }

        return (string) $count;
    }

    /**
     * Request the page profile from the Graph API.
     *
     * @return array{name: string, about: ?string, category: ?string, link: string, followers_count: int, fan_count: int, picture_url: ?string, cover_url: ?string}|null
     */
    private function fetch(): ?array
    {
        $pageId = config('services.facebook.page_id');

        try {
            $response = Http::connectTimeout(3)->timeout(4)
                ->retry(1, 200, throw: false)
                ->get(sprintf('https://graph.facebook.com/%s/%s', config('services.facebook.graph_version'), $pageId), [
                    'fields' => self::FIELDS,
                    'access_token' => config('services.facebook.page_access_token'),
                ]);
        } catch (ConnectionException $exception) {
            Log::warning('Facebook page profile request could not connect.', ['message' => $exception->getMessage()]);

            return null;
        }

        if ($response->failed() || blank($response->json('name'))) {
            Log::warning('Facebook page profile request failed.', [
                'status' => $response->status(),
                'error' => $response->json('error.message'),
            ]);

            return null;
        }

        return [
            'name' => $response->json('name'),
            'about' => $response->json('about'),
            'category' => $response->json('category'),
            'link' => $response->json('link') ?? 'https://www.facebook.com/'.$pageId,
            'followers_count' => (int) $response->json('followers_count', 0),
            'fan_count' => (int) $response->json('fan_count', 0),
            'picture_url' => $response->json('picture.data.url'),
            'cover_url' => $response->json('cover.source'),
        ];
    }
}
