@extends('layouts.app')

@section('content')
    <section class="relative overflow-hidden bg-base-200 pt-32 pb-12 sm:pt-40 sm:pb-16">
        <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_top,black_20%,transparent_70%)]"></div>

        <div class="relative mx-auto max-w-4xl px-4 lg:px-8">
            <span class="inline-flex size-14 items-center justify-center rounded-2xl bg-brand-gradient text-white shadow-lg shadow-primary/25">
                <i class="{{ $pages[$currentPage]['icon'] }} text-3xl"></i>
            </span>
            <h1 class="mt-5 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __($pages[$currentPage]['title']) }}</h1>
            <p class="mt-3 text-base-content/60">{{ __('Last updated: :date', ['date' => $lastUpdated]) }}</p>

            <nav class="mt-8 flex flex-wrap gap-2" aria-label="{{ __('Legal documents') }}">
                @foreach ($pages as $pageKey => $page)
                    <a href="{{ route($page['route']) }}" @class([
                        'inline-flex items-center gap-2 rounded-full border px-4 py-2 text-sm font-semibold transition',
                        'border-primary bg-primary text-primary-content' => $pageKey === $currentPage,
                        'border-base-300 bg-base-100 text-base-content/70 hover:border-primary hover:text-primary' => $pageKey !== $currentPage,
                    ]) @if ($pageKey === $currentPage) aria-current="page" @endif>
                        <i class="{{ $page['icon'] }} text-base"></i>
                        {{ __($page['title']) }}
                    </a>
                @endforeach
            </nav>
        </div>
    </section>

    <section class="py-12 sm:py-16">
        <article class="legal-prose mx-auto max-w-4xl px-4 lg:px-8">
            @include($contentView, ['company' => config('company')])
        </article>
    </section>
@endsection
