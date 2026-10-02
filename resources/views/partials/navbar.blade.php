@php
    $navigationLinks = [
        ['label' => __('Services'), 'href' => '#services'],
        ['label' => __('Advantages'), 'href' => '#why-us'],
        ['label' => __('Process'), 'href' => '#process'],
        ['label' => __('FAQ'), 'href' => '#faq'],
    ];

    $currentLocale = app()->getLocale();
@endphp

<header class="fixed inset-x-0 top-0 z-50 px-3 pt-3 sm:px-4 sm:pt-4">
    <nav data-navbar class="mx-auto max-w-7xl rounded-3xl border border-base-300/70 bg-base-100/85 backdrop-blur-xl transition-shadow duration-300">
        <div class="flex h-16 items-center justify-between gap-4 px-4 sm:h-[4.5rem] sm:px-5">
            {{-- Brand --}}
            <a href="{{ route('home') }}" class="flex shrink-0 items-center" aria-label="{{ __(config('company.name')) }}">
                <x-logo :alt="__(config('company.name'))" class="h-11 sm:h-12" />
            </a>

            {{-- Desktop links --}}
            <ul data-nav-track class="relative hidden items-center gap-1 rounded-2xl bg-base-200/70 p-1.5 lg:flex">
                <span data-nav-indicator class="pointer-events-none absolute top-1.5 bottom-1.5 left-0 w-0 rounded-xl bg-base-100 opacity-0 shadow-sm transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)]" aria-hidden="true"></span>
                @foreach ($navigationLinks as $navigationLink)
                    <li class="relative z-10">
                        <a href="{{ $navigationLink['href'] }}" data-nav-link class="block rounded-xl px-4 py-2 text-sm font-semibold text-base-content/70 transition-colors duration-300 hover:text-primary aria-[current=true]:text-primary">
                            {{ $navigationLink['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Actions --}}
            <div class="flex items-center gap-2">
                <div class="dropdown relative inline-flex [--placement:bottom-end]">
                    <button id="locale-dropdown" type="button" class="dropdown-toggle btn btn-text h-10 min-h-10 gap-1.5 rounded-xl px-3 text-sm font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="{{ __('Change language') }}">
                        <i class="ti ti-world text-lg"></i>
                        {{ $currentLocale }}
                        <i class="ti ti-chevron-down text-sm transition-transform dropdown-open:rotate-180"></i>
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
                    <i class="ti ti-moon text-xl dark:hidden"></i>
                    <i class="ti ti-sun hidden text-xl dark:inline-block"></i>
                </button>

                <a href="#contact" class="btn hidden h-11 min-h-11 rounded-xl border-0 bg-brand-gradient px-5 text-sm text-white shadow-lg shadow-primary/25 hover:opacity-90 sm:inline-flex">
                    {{ __('Get a quote') }}
                    <i class="ti ti-arrow-up-right text-lg"></i>
                </a>

                <button type="button" class="collapse-toggle btn btn-text btn-square size-10 min-h-10 rounded-xl lg:hidden" data-collapse="#mobile-navigation" aria-controls="mobile-navigation" aria-label="{{ __('Open menu') }}">
                    <i class="ti ti-menu-2 text-2xl collapse-open:hidden"></i>
                    <i class="ti ti-x hidden text-2xl collapse-open:block"></i>
                </button>
            </div>
        </div>

        {{-- Mobile links --}}
        <div id="mobile-navigation" class="collapse hidden w-full overflow-hidden transition-[height] duration-300 lg:hidden">
            <ul class="space-y-1 border-t border-base-300/70 p-3">
                @foreach ($navigationLinks as $navigationLink)
                    <li>
                        <a href="{{ $navigationLink['href'] }}" data-nav-link class="flex items-center justify-between rounded-xl px-4 py-3 font-semibold text-base-content/80 transition-colors duration-300 hover:bg-primary/10 hover:text-primary aria-[current=true]:bg-primary/10 aria-[current=true]:text-primary">
                            {{ $navigationLink['label'] }}
                            <i class="ti ti-chevron-right text-base-content/40"></i>
                        </a>
                    </li>
                @endforeach
                <li class="pt-2 sm:hidden">
                    <a href="#contact" class="btn btn-block h-12 rounded-xl border-0 bg-brand-gradient text-white">
                        {{ __('Get a quote') }}
                        <i class="ti ti-arrow-up-right text-lg"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
