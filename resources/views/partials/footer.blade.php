<footer
    class="relative overflow-hidden bg-brand-night text-white/70 dark:border-t dark:border-base-300 dark:bg-base-200">
    <div class="pointer-events-none absolute -top-40 left-1/2 size-[36rem] -translate-x-1/2 glow-brand-indigo/40"></div>

    <div class="relative mx-auto grid max-w-7xl gap-12 px-4 py-16 md:grid-cols-12 lg:px-8">
        <div class="md:col-span-12 lg:col-span-4">
            <img src="{{ asset('assets/logo/horiz_white.png') }}" alt="{{ __(config('company.name')) }}"
                class="h-12 w-auto">
            <p class="mt-6 max-w-sm leading-relaxed">
                {{ __('We power your business’s digital transformation with websites, online payments, e-commerce and reliable server infrastructure.') }}
            </p>
            <p
                class="mt-6 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white">
                <i class="icon-[tabler--sparkles] text-brand-blue"></i>
                {{ __(config('company.slogan')) }}
            </p>
        </div>

        <div class="md:col-span-4 lg:col-span-3">
            <h3 class="text-sm font-semibold tracking-wider text-white uppercase">{{ __('Services') }}</h3>
            <ul class="mt-5 space-y-3">
                @foreach (\App\Support\SiteContent::services() as $footerService)
                    <li><a href="{{ $footerService['url'] }}" class="hover:text-white">{{ $footerService['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="md:col-span-4 lg:col-span-2">
            <h3 class="text-sm font-semibold tracking-wider text-white uppercase">{{ __('Knowledge') }}</h3>
            <ul class="mt-5 space-y-3">
                @foreach (\App\Support\SiteContent::articles() as $footerArticle)
                    <li><a href="{{ $footerArticle['url'] }}" class="hover:text-white">{{ $footerArticle['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="md:col-span-4 lg:col-span-3">
            <h3 class="text-sm font-semibold tracking-wider text-white uppercase">{{ __('Contact') }}</h3>
            <ul class="mt-5 space-y-3">
                <li class="flex items-center gap-3">
                    <i class="icon-[tabler--mail] text-xl text-brand-blue"></i>
                    <a href="mailto:{{ config('company.email') }}"
                        class="hover:text-white">{{ config('company.email') }}</a>
                </li>
                <li class="flex items-center gap-3">
                    <i class="icon-[tabler--phone] text-xl text-brand-blue"></i>
                    <a href="tel:{{ str_replace(' ', '', config('company.phone')) }}"
                        class="hover:text-white">{{ config('company.phone') }}</a>
                </li>
                <li class="flex items-center gap-3">
                    <i class="icon-[tabler--map-pin] text-xl text-brand-blue"></i>
                    <span>{{ __(config('company.address')) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="relative border-t border-white/10">
        {{-- Extra bottom padding on phones keeps the floating Messenger button off the text. --}}
        <div
            class="mx-auto flex max-w-7xl flex-col-reverse items-center justify-between gap-5 px-4 pt-6 pb-6 text-sm sm:pb-6 md:flex-row md:gap-3 lg:px-8">
            <p class="text-center text-white/50 md:text-start">&copy; {{ now()->year }}
                {{ __(config('company.name')) }}. {{ __('All rights reserved.') }}</p>

            <nav class="flex w-full flex-wrap items-center justify-center gap-x-1 gap-y-2 border-b border-white/10 pb-5 md:w-auto md:border-0 md:pb-0"
                aria-label="{{ __('Legal documents') }}">
                @foreach (\App\Http\Controllers\LegalPageController::PAGES as $legalPage)
                    @unless ($loop->first)
                        <span class="text-white/25" aria-hidden="true">•</span>
                    @endunless
                    <a href="{{ route($legalPage['route']) }}"
                        class="rounded-lg px-2 py-1 transition hover:bg-white/10 hover:text-white">{{ __($legalPage['title']) }}</a>
                @endforeach
            </nav>
        </div>
    </div>
</footer>
