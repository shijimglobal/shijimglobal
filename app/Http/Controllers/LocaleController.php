<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Store the visitor's preferred locale and return to the previous page.
     */
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        abort_unless(array_key_exists($locale, config('company.locales')), 404);

        $request->session()->put('locale', $locale);

        return redirect()->back(fallback: route('home'));
    }
}
