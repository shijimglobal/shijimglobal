<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServicePageController extends Controller
{
    /**
     * Permanently redirect an old Mongolian service address to its English one.
     */
    public function redirectLegacy(string $slug): RedirectResponse
    {
        $service = SiteContent::serviceByLegacySlug($slug);

        abort_if($service === null, 404);

        return redirect()->to($service['url'], 301);
    }

    /**
     * Show a single service page.
     */
    public function show(string $slug): View
    {
        $service = SiteContent::serviceBySlug($slug);

        abort_if($service === null, 404);

        return view('pages.services.show', [
            'service' => $service,
            'relatedArticle' => SiteContent::articles()->get($service['article']),
            'otherServices' => SiteContent::services()->except($service['key']),
            'title' => $service['seo_title'].' | '.__('Shijim Global'),
            'metaDescription' => $service['seo_description'],
        ]);
    }
}
