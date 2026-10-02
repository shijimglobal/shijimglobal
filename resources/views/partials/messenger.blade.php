@if (config('company.messenger'))
    <a href="{{ config('company.messenger') }}" data-desktop-href="{{ \App\Services\FacebookPageService::desktopMessengerUrl() }}" data-app-href="{{ \App\Services\FacebookPageService::messengerAppUrl() }}" target="_blank" rel="noopener" class="group fixed end-4 bottom-10 z-40 flex items-center gap-3 rounded-full outline-none sm:end-6 sm:bottom-14" aria-label="{{ __('Chat on Messenger') }}">
        <span class="hidden rounded-2xl border border-base-300 bg-base-100 px-4 py-2.5 text-sm font-semibold text-base-content opacity-0 shadow-xl transition duration-300 group-hover:translate-x-0 group-hover:opacity-100 sm:block sm:translate-x-2">
            {{ __('Chat with us') }}
        </span>
        <span class="relative flex size-14 items-center justify-center rounded-full bg-gradient-to-br from-[#00b2ff] via-[#7a5cff] to-[#ff5a8a] text-white shadow-xl shadow-primary/30 transition duration-300 group-hover:scale-110 group-focus-visible:ring-4 group-focus-visible:ring-primary/40">
            <span class="absolute inset-0 animate-ping rounded-full bg-[#7a5cff]/40 [animation-duration:2.5s]"></span>
            <i class="ti ti-brand-messenger relative text-3xl"></i>
        </span>
    </a>

    {{-- Shown on phones when the Messenger app did not open --}}
    <div data-messenger-fallback class="pointer-events-none fixed inset-x-4 bottom-28 z-50 translate-y-4 opacity-0 transition duration-300 sm:hidden" role="status">
        <div class="pointer-events-auto flex items-center gap-3 rounded-2xl border border-base-300 bg-base-100 p-3 shadow-2xl">
            <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#1877f2]/10 text-[#1877f2]">
                <i class="ti ti-brand-messenger text-xl"></i>
            </span>
            <p class="min-w-0 flex-1 text-sm font-semibold">{{ __('Messenger did not open?') }}</p>
            <a href="{{ config('company.messenger') }}" target="_blank" rel="noopener" class="btn btn-sm h-9 rounded-xl border-0 bg-[#1877f2] text-white">{{ __('Open in browser') }}</a>
            <button type="button" data-messenger-fallback-close class="flex size-8 items-center justify-center rounded-lg text-base-content/50" aria-label="{{ __('Close') }}">
                <i class="ti ti-x"></i>
            </button>
        </div>
    </div>
@endif
