<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Serve the XML sitemap that search engines use to discover public pages.
     */
    public function __invoke(): Response
    {
        $lastModified = max(
            filemtime(resource_path('views/home.blade.php')),
            filemtime(lang_path('mn.json')),
        );

        $legalPages = collect(LegalPageController::PAGES)->map(fn (array $legalPage): array => [
            'url' => route($legalPage['route']),
            'last_modified' => LegalPageController::LAST_UPDATED,
            'priority' => '0.3',
        ]);

        return response()
            ->view('sitemap', [
                'pages' => [
                    ['url' => route('home'), 'last_modified' => date('Y-m-d', $lastModified), 'priority' => '1.0'],
                    ...$legalPages->values()->all(),
                ],
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
