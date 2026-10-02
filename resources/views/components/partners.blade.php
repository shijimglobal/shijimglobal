@php $trackPartners = $track(); @endphp

<section id="partners" class="border-y border-base-300/60 bg-base-100 py-12 sm:py-16" aria-labelledby="partners-heading">
    <div class="mx-auto max-w-7xl px-4 lg:px-8">
        <p id="partners-heading" class="text-center text-sm font-bold tracking-widest text-base-content/50 uppercase">
            {{ __('Our partners') }}
        </p>
    </div>

    <div class="marquee group relative mt-8 overflow-hidden [mask-image:linear-gradient(to_right,transparent,black_10%,black_90%,transparent)]">
        <div class="marquee-track flex w-max group-hover:[animation-play-state:paused]">
            {{-- The track is rendered twice so the -50% loop is seamless; the copy is hidden from screen readers. --}}
            @foreach ([false, true] as $isDuplicate)
                <ul class="flex shrink-0 items-center gap-4 pe-4 sm:gap-6 sm:pe-6" @if ($isDuplicate) aria-hidden="true" @endif>
                    @foreach ($trackPartners as $partner)
                        <li class="shrink-0">
                            @if ($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener" @if ($isDuplicate) tabindex="-1" @endif class="partner-logo" title="{{ $partner->name }}">
                                    <img src="{{ $partner->logo_url }}" alt="{{ $isDuplicate ? '' : $partner->name }}" loading="lazy" decoding="async" class="max-h-full max-w-full object-contain">
                                </a>
                            @else
                                <span class="partner-logo" title="{{ $partner->name }}">
                                    <img src="{{ $partner->logo_url }}" alt="{{ $isDuplicate ? '' : $partner->name }}" loading="lazy" decoding="async" class="max-h-full max-w-full object-contain">
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</section>
