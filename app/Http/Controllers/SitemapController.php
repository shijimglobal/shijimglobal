<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Serve the XML sitemap that search engines use to discover public pages.
     */
    public function __invoke(): Response
    {
        $contentUpdated = date('Y-m-d', max(
            filemtime(resource_path('views/home.blade.php')),
            filemtime(lang_path('mn.json')),
            filemtime(lang_path('mn/pages.php')),
        ));

        $page = fn (string $url, string $priority, ?string $lastModified = null): array => [
            'url' => $url,
            'last_modified' => $lastModified ?? $contentUpdated,
            'priority' => $priority,
        ];

        $pages = [
            $page(route('home'), '1.0'),
            ...SiteContent::services()->map(fn (array $service): array => $page($service['url'], '0.9'))->values()->all(),
            $page(route('articles.index'), '0.7'),
            ...SiteContent::articles()->map(fn (array $article): array => $page($article['url'], '0.7'))->values()->all(),
            ...collect(LegalPageController::PAGES)
                ->map(fn (array $legalPage): array => $page(route($legalPage['route']), '0.3', LegalPageController::LAST_UPDATED))
                ->values()
                ->all(),
        ];

        return response()
            ->view('sitemap', ['pages' => $pages])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
