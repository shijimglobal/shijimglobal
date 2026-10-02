<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class LegalPageController extends Controller
{
    /**
     * Legal documents keyed by page, with their translation-key titles.
     *
     * @var array<string, array{title: string, icon: string, route: string}>
     */
    public const PAGES = [
        'privacy' => ['title' => 'Privacy Policy', 'icon' => 'icon-[tabler--shield-lock]', 'route' => 'legal.privacy'],
        'terms' => ['title' => 'Terms of Service', 'icon' => 'icon-[tabler--file-text]', 'route' => 'legal.terms'],
        'data-deletion' => ['title' => 'Data Deletion', 'icon' => 'icon-[tabler--trash]', 'route' => 'legal.data-deletion'],
    ];

    /**
     * Date the legal documents were last updated.
     */
    public const LAST_UPDATED = '2026-10-03';

    /**
     * Show the privacy policy.
     */
    public function privacy(): ViewResponse
    {
        return $this->render('privacy');
    }

    /**
     * Show the terms of service.
     */
    public function terms(): ViewResponse
    {
        return $this->render('terms');
    }

    /**
     * Show the data deletion instructions.
     */
    public function dataDeletion(): ViewResponse
    {
        return $this->render('data-deletion');
    }

    /**
     * Render a legal page in the current language, falling back to Mongolian.
     */
    private function render(string $page): ViewResponse
    {
        $locale = app()->getLocale();
        $contentView = View::exists("legal.{$page}.{$locale}") ? "legal.{$page}.{$locale}" : "legal.{$page}.mn";

        return view('legal.show', [
            'title' => __(self::PAGES[$page]['title']).' — '.__(config('company.name')),
            'currentPage' => $page,
            'pages' => self::PAGES,
            'contentView' => $contentView,
            'lastUpdated' => self::LAST_UPDATED,
        ]);
    }
}
