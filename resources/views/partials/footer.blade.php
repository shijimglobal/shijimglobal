<footer class="relative overflow-hidden bg-brand-night text-white/70 dark:border-t dark:border-base-300 dark:bg-base-200">
    <div class="pointer-events-none absolute -top-40 left-1/2 size-[36rem] -translate-x-1/2 glow-brand-indigo/40"></div>

    <div class="relative mx-auto grid max-w-7xl gap-12 px-4 py-16 md:grid-cols-12 lg:px-8">
        <div class="md:col-span-5">
            <img src="{{ asset('assets/logo/horiz_white.png') }}" alt="{{ __(config('company.name')) }}" class="h-12 w-auto">
            <p class="mt-6 max-w-sm leading-relaxed">
                {{ __('We power your business’s digital transformation with websites, online payments, e-commerce and reliable server infrastructure.') }}
            </p>
            <p class="mt-6 inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white">
                <i class="icon-[tabler--sparkles] text-brand-blue"></i>
                {{ __(config('company.slogan')) }}
            </p>
        </div>

        <div class="md:col-span-3">
            <h3 class="text-sm font-semibold tracking-wider text-white uppercase">{{ __('Services') }}</h3>
            <ul class="mt-5 space-y-3">
                <li><a href="{{ request()->routeIs('home') ? '' : route('home') }}#services" class="hover:text-white">{{ __('Company website') }}</a></li>
                <li><a href="{{ request()->routeIs('home') ? '' : route('home') }}#services" class="hover:text-white">{{ __('Online payments') }}</a></li>
                <li><a href="{{ request()->routeIs('home') ? '' : route('home') }}#services" class="hover:text-white">{{ __('E-commerce') }}</a></li>
                <li><a href="{{ request()->routeIs('home') ? '' : route('home') }}#services" class="hover:text-white">{{ __('Server setup & rental') }}</a></li>
            </ul>
        </div>

        <div class="md:col-span-4">
            <h3 class="text-sm font-semibold tracking-wider text-white uppercase">{{ __('Contact') }}</h3>
            <ul class="mt-5 space-y-3">
                <li class="flex items-center gap-3">
                    <i class="icon-[tabler--mail] text-xl text-brand-blue"></i>
                    <a href="mailto:{{ config('company.email') }}" class="hover:text-white">{{ config('company.email') }}</a>
                </li>
                <li class="flex items-center gap-3">
                    <i class="icon-[tabler--phone] text-xl text-brand-blue"></i>
                    <a href="tel:{{ str_replace(' ', '', config('company.phone')) }}" class="hover:text-white">{{ config('company.phone') }}</a>
                </li>
                <li class="flex items-center gap-3">
                    <i class="icon-[tabler--map-pin] text-xl text-brand-blue"></i>
                    <span>{{ __(config('company.address')) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="relative border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-6 text-sm sm:flex-row lg:px-8">
            <p>&copy; {{ now()->year }} {{ __(config('company.name')) }}. {{ __('All rights reserved.') }}</p>
            <nav class="flex flex-wrap items-center justify-center gap-x-5 gap-y-2" aria-label="{{ __('Legal documents') }}">
                @foreach (\App\Http\Controllers\LegalPageController::PAGES as $legalPage)
                    <a href="{{ route($legalPage['route']) }}" class="hover:text-white">{{ __($legalPage['title']) }}</a>
                @endforeach
            </nav>
        </div>
    </div>
</footer>
