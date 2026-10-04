<?php

namespace App\Http\Controllers;

use App\Support\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * List the knowledge articles.
     */
    public function index(): View
    {
        return view('pages.articles.index', [
            'articles' => SiteContent::articles(),
            'title' => __('Knowledge').' — '.__('Websites, servers and online payments explained').' | '.__('Shijim Global'),
            'metaDescription' => __('Short, clear guides about websites, servers, VPS and online payments for business owners.'),
        ]);
    }

    /**
     * Permanently redirect an old Mongolian article address to its English one.
     */
    public function redirectLegacy(string $slug): RedirectResponse
    {
        $article = SiteContent::articleByLegacySlug($slug);

        abort_if($article === null, 404);

        return redirect()->to($article['url'], 301);
    }

    /**
     * Show a single infographic article.
     */
    public function show(string $slug): View
    {
        $article = SiteContent::articleBySlug($slug);

        abort_if($article === null, 404);

        return view('pages.articles.show', [
            'article' => $article,
            'relatedService' => SiteContent::services()->get($article['service']),
            'otherArticles' => SiteContent::articles()->except($article['key']),
            'title' => $article['title'].' | '.__('Shijim Global'),
            'metaDescription' => $article['seo_description'],
            'metaType' => 'article',
        ]);
    }
}
