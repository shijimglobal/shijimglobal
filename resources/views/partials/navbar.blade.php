@php
    // Legal pages have no contact form of their own, so the call to action leads back home.
    $homeAnchorPrefix = request()->routeIs('legal.*') ? route('home') : '';

    $currentLocale = app()->getLocale();
@endphp

<header class="fixed inset-x-0 top-0 z-50 px-3 pt-3 sm:px-4 sm:pt-4">
    <nav data-navbar class="mx-auto max-w-7xl rounded-3xl border border-base-300/70 bg-base-100/85 backdrop-blur-md transition-shadow duration-300">
        <div class="flex h-16 items-center justify-between gap-4 px-4 sm:h-[4.5rem] sm:px-5">
            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="{{ __(config('company.name')) }}">
                <x-logo :alt="__(config('company.name'))" class="h-11 sm:h-12" />
            </a>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <div class="dropdown relative hidden [--placement:bottom-end] lg:inline-flex">
                    <button id="locale-dropdown" type="button" class="dropdown-toggle btn btn-text h-10 min-h-10 gap-1.5 rounded-xl px-3 text-sm font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="{{ __('Change language') }}">
                        <i class="icon-[tabler--world] text-lg"></i>
                        {{ $currentLocale }}
                        <i class="icon-[tabler--chevron-down] text-sm transition-transform dropdown-open:rotate-180"></i>
                    </button>
                    <ul class="dropdown-menu hidden min-w-44 rounded-2xl border border-base-300 p-2 shadow-xl dropdown-open:opacity-100" role="menu" aria-orientation="vertical" aria-labelledby="locale-dropdown">
                        @foreach (config('company.locales') as $localeCode => $localeName)
                            <li>
                                <a href="{{ route('locale.switch', $localeCode) }}" class="dropdown-item justify-between rounded-xl {{ $localeCode === $currentLocale ? 'bg-primary/10 font-semibold text-primary' : '' }}">
                                    {{ $localeName }}
                                    <span class="text-xs font-bold uppercase opacity-60">{{ $localeCode }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <button type="button" data-theme-toggle class="btn btn-text btn-square size-10 min-h-10 rounded-xl" aria-label="{{ __('Toggle dark mode') }}">
                    <i class="icon-[tabler--moon] text-xl dark:hidden"></i>
                    <i class="icon-[tabler--sun] hidden text-xl dark:inline-block"></i>
                </button>

                <a href="{{ $homeAnchorPrefix }}#contact" class="btn btn-cta hidden border-0 bg-brand-gradient text-white shadow-lg shadow-primary/25 hover:opacity-90 sm:inline-flex">
                    {{ __('Get a quote') }}
                    <i class="icon-[tabler--arrow-up-right] text-lg"></i>
                </a>

                <button type="button" class="collapse-toggle btn btn-text btn-square size-10 min-h-10 rounded-xl lg:hidden" data-collapse="#mobile-navigation" aria-controls="mobile-navigation" aria-label="{{ __('Open menu') }}">
                    <i class="icon-[tabler--menu-2] text-2xl collapse-open:hidden"></i>
                    <i class="icon-[tabler--x] hidden text-2xl collapse-open:block"></i>
                </button>
            </div>
        </div>

        {{-- Mobile menu: language and quote button --}}
        <div id="mobile-navigation" class="collapse hidden w-full overflow-hidden transition-[height] duration-300 lg:hidden">
            <ul class="space-y-1 border-t border-base-300/70 p-3">
                <li>
                    <div class="flex items-center justify-between gap-3 px-4 py-1">
                        <span class="flex items-center gap-2 text-sm font-semibold text-base-content/70">
                            <i class="icon-[tabler--world] text-lg"></i>
                            {{ __('Language') }}
                        </span>
                        <div class="inline-flex rounded-xl bg-base-200/80 p-1" role="group" aria-label="{{ __('Change language') }}">
                            @foreach (config('company.locales') as $localeCode => $localeName)
                                <a href="{{ route('locale.switch', $localeCode) }}" title="{{ $localeName }}" @class([
                                    'rounded-lg px-3.5 py-1.5 text-sm font-bold uppercase transition',
                                    'bg-base-100 text-primary shadow-sm' => $localeCode === $currentLocale,
                                    'text-base-content/60 hover:text-primary' => $localeCode !== $currentLocale,
                                ]) @if ($localeCode === $currentLocale) aria-current="true" @endif>{{ $localeCode }}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="pt-2 sm:hidden">
                    <a href="{{ $homeAnchorPrefix }}#contact" class="btn btn-cta btn-block border-0 bg-brand-gradient text-white">
                        {{ __('Get a quote') }}
                        <i class="icon-[tabler--arrow-up-right] text-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
