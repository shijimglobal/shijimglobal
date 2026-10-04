<?php

namespace App\Support;

use Illuminate\Support\Collection;

/**
 * Combines the language-independent page settings (config/pages.php)
 * with the translated texts (lang/{locale}/pages.php).
 */
class SiteContent
{
    /**
     * All services in display order, keyed by service key.
     *
     * @return Collection<string, array<string, mixed>>
     */
    public static function services(): Collection
    {
        return collect(config('pages.services'))->map(fn (array $settings, string $key): array => [
            'key' => $key,
            ...$settings,
            ...trans("pages.services.{$key}"),
            'url' => route('services.show', $settings['slug']),
        ]);
    }

    /**
     * Find a service by its URL slug.
     *
     * @return array<string, mixed>|null
     */
    public static function serviceBySlug(string $slug): ?array
    {
        return self::services()->firstWhere('slug', $slug);
    }

    /**
     * Find a service by the Mongolian slug it used before the English addresses.
     *
     * @return array<string, mixed>|null
     */
    public static function serviceByLegacySlug(string $legacySlug): ?array
    {
        return self::services()->firstWhere('legacy_slug', $legacySlug);
    }

    /**
     * Find an article by the Mongolian slug it used before the English addresses.
     *
     * @return array<string, mixed>|null
     */
    public static function articleByLegacySlug(string $legacySlug): ?array
    {
        return self::articles()->firstWhere('legacy_slug', $legacySlug);
    }

    /**
     * All knowledge articles, keyed by article key.
     *
     * @return Collection<string, array<string, mixed>>
     */
    public static function articles(): Collection
    {
        return collect(config('pages.articles'))->map(fn (array $settings, string $key): array => [
            'key' => $key,
            ...$settings,
            ...trans("pages.articles.{$key}"),
            'url' => route('articles.show', $settings['slug']),
        ]);
    }

    /**
     * Find an article by its URL slug.
     *
     * @return array<string, mixed>|null
     */
    public static function articleBySlug(string $slug): ?array
    {
        return self::articles()->firstWhere('slug', $slug);
    }

    /**
     * Frequently asked questions.
     *
     * @return list<array{question: string, answer: string}>
     */
    public static function faqs(): array
    {
        return trans('pages.faq');
    }
}
