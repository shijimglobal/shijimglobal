<section id="facebook" class="pt-16 pb-4 sm:pt-24 sm:pb-8 lg:pt-32">
    <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-8">
        <div
            class="relative grid items-center gap-10 overflow-hidden rounded-3xl border border-[#1877f2]/15 bg-gradient-to-br from-[#1877f2]/[0.07] via-base-100 to-brand-indigo/[0.07] px-5 py-10 sm:rounded-[2.5rem] sm:p-10 lg:grid-cols-2 lg:gap-16 lg:p-14">
            <div
                class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_left,black_10%,transparent_60%)]">
            </div>
            <div class="pointer-events-none absolute -right-24 -bottom-24 size-80 rounded-full bg-[#1877f2]/15 blur-3xl">
            </div>

            <div class="relative" data-reveal>
                <span class="inline-flex items-center gap-2 text-sm font-bold tracking-widest text-[#1877f2] uppercase">
                    <i class="ti ti-brand-facebook text-lg"></i>
                    Facebook
                </span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-balance sm:text-4xl">
                    {{ __('Follow us on Facebook') }}</h2>
                <p class="mt-4 text-lg leading-relaxed text-base-content/70">
                    {{ __('Be the first to hear about our latest work, special offers and useful tips for growing your business online.') }}
                </p>

                <ul class="mt-8 space-y-3">
                    @foreach ([['ti-news', __('News and announcements')], ['ti-discount-2', __('Special offers')], ['ti-message-circle', __('Quick replies on Messenger')]] as [$benefitIcon, $benefitLabel])
                        <li class="flex items-center gap-3 font-medium text-base-content/80">
                            <span
                                class="flex size-9 items-center justify-center rounded-xl bg-[#1877f2]/10 text-[#1877f2]"><i
                                    class="ti {{ $benefitIcon }} text-lg"></i></span>
                            {{ $benefitLabel }}
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Page card --}}
            <article
                class="relative mx-auto w-full max-w-md overflow-hidden rounded-[2rem] border border-base-300 bg-base-100 shadow-2xl shadow-[#1877f2]/10"
                data-reveal>
                {{-- Cover --}}
                <div class="relative aspect-[2.6/1] bg-gradient-to-br from-[#1877f2] via-brand-indigo to-brand-violet">
                    @if ($profile['cover_url'])
                        <img src="{{ $profile['cover_url'] }}" alt="" class="size-full object-cover"
                            loading="lazy" referrerpolicy="no-referrer" onerror="this.remove()">
                    @endif
                    <div
                        class="pointer-events-none absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/25 to-transparent">
                    </div>
                    <a href="{{ $profile['link'] }}" target="_blank" rel="noopener"
                        class="absolute top-3 right-3 flex size-9 items-center justify-center rounded-full bg-[#1877f2] text-white shadow-lg ring-2 ring-white/80 transition hover:scale-110"
                        aria-label="Facebook">
                        <i class="ti ti-brand-facebook text-xl"></i>
                    </a>
                </div>

                <div class="px-5 pb-6 sm:px-6">
                    {{-- Avatar and name --}}
                    <div class="relative z-10 -mt-10 flex items-end gap-4">
                        <span
                            class="flex size-24 shrink-0 items-center justify-center overflow-hidden rounded-full bg-white shadow-xl ring-4 ring-base-100">
                            @if ($profile['picture_url'])
                                <img src="{{ $profile['picture_url'] }}" alt="{{ $profile['name'] }}"
                                    class="size-full object-cover" loading="lazy" referrerpolicy="no-referrer"
                                    onerror="this.replaceWith(Object.assign(document.createElement('img'), { src: '{{ asset('assets/logo/Asset 5.png') }}', className: 'size-14' }))">
                            @else
                                <img src="{{ asset('assets/logo/Asset 5.png') }}" alt="{{ $profile['name'] }}"
                                    class="size-14">
                            @endif
                        </span>
                        <div class="min-w-0 -mb-2">
                            <h3 class="truncate text-lg leading-tight font-semibold sm:text-xl">{{ $profile['name'] }}
                            </h3>
                            @if ($profile['category'])
                                <p class="mt-0.5 truncate text-sm text-base-content/55">{{ $profile['category'] }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Stats --}}
                    <dl
                        class="mt-6 grid grid-cols-2 divide-x divide-base-300 rounded-2xl border border-base-300/80 bg-base-200/50">
                        <div class="flex items-center gap-3 px-4 py-3.5">
                            <span
                                class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#1877f2]/10 text-[#1877f2]"><i
                                    class="ti ti-users text-xl"></i></span>
                            <div class="min-w-0">
                                <dd class="text-xl leading-none font-extrabold"
                                    title="{{ number_format($profile['followers_count']) }}">
                                    {{ $abbreviate($profile['followers_count']) }}</dd>
                                <dt class="mt-1 truncate text-xs font-semibold text-base-content/55">
                                    {{ __('Followers') }}</dt>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3.5">
                            <span
                                class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-[#1877f2]/10 text-[#1877f2]"><i
                                    class="ti ti-thumb-up text-xl"></i></span>
                            <div class="min-w-0">
                                <dd class="text-xl leading-none font-extrabold"
                                    title="{{ number_format($profile['fan_count']) }}">
                                    {{ $abbreviate($profile['fan_count']) }}</dd>
                                <dt class="mt-1 truncate text-xs font-semibold text-base-content/55">
                                    {{ __('Likes') }}</dt>
                            </div>
                        </div>
                    </dl>

                    @if ($profile['about'])
                        <p class="mt-5 line-clamp-3 text-sm leading-relaxed text-base-content/70">
                            {{ $profile['about'] }}</p>
                    @endif

                    <div class="mt-6 grid gap-2 {{ config('company.messenger') ? 'grid-cols-2' : '' }}">
                        <a href="{{ $profile['link'] }}" target="_blank" rel="noopener"
                            class="btn h-12 rounded-2xl border-0 bg-[#1877f2] text-white shadow-lg shadow-[#1877f2]/30 hover:bg-[#166fe0]">
                            <i class="ti ti-user-plus text-lg"></i>
                            {{ __('Follow') }}
                        </a>
                        @if (config('company.messenger'))
                            <a href="{{ config('company.messenger') }}" data-desktop-href="{{ \App\Services\FacebookPageService::desktopMessengerUrl() }}" data-app-href="{{ \App\Services\FacebookPageService::messengerAppUrl() }}" target="_blank" rel="noopener"
                                class="btn btn-outline h-12 rounded-2xl border-base-300 hover:border-[#1877f2] hover:bg-[#1877f2]/5 hover:text-[#1877f2]">
                                <i class="ti ti-brand-messenger text-lg"></i>
                                {{ __('Message') }}
                            </a>
                        @endif
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
