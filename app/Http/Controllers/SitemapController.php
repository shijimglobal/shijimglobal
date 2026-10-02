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

        return response()
            ->view('sitemap', [
                'pages' => [
                    ['url' => route('home'), 'last_modified' => date('Y-m-d', $lastModified), 'priority' => '1.0'],
                ],
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
