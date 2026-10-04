@php $serviceCards = \App\Support\SiteContent::services()->values(); @endphp

{{-- Services --}}
<section id="services" class="bg-base-200 py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 lg:px-8">
        @unless ($hideHeading ?? false)
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="text-sm font-bold tracking-widest text-primary uppercase">{{ __('Services') }}</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Digital solutions for your business') }}</h2>
                <p class="mt-4 text-lg text-base-content/70">{{ __('Everything from websites to server infrastructure, in one place.') }}</p>
            </div>
        @endunless

        <div @class(['grid gap-6 sm:grid-cols-2 lg:grid-cols-3', 'mt-16' => ! ($hideHeading ?? false)])>
            @foreach ($serviceCards as $service)
                <a href="{{ $service['url'] }}" @class([
                    'group relative flex flex-col overflow-hidden rounded-3xl border border-base-300 bg-base-100 p-8 hover:-translate-y-1 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10',
                    'lg:col-span-2' => $loop->first,
                ]) data-reveal>
                    <div class="pointer-events-none absolute -top-32 -right-32 size-80 scale-75 glow-primary/25 opacity-0 transition-[opacity,scale] duration-700 ease-out group-hover:scale-100 group-hover:opacity-100"></div>

                    <span class="flex size-14 items-center justify-center rounded-2xl bg-brand-gradient text-white shadow-lg shadow-primary/25">
                        <i class="{{ $service['icon'] }} text-3xl"></i>
                    </span>

                    <h3 class="mt-6 text-xl font-bold">{{ $service['title'] }}</h3>
                    <p class="mt-3 leading-relaxed text-base-content/70">{{ $service['summary'] }}</p>

                    <ul class="mt-6 flex flex-wrap gap-2">
                        @foreach ($service['features'] as $feature)
                            <li class="rounded-full bg-base-200 px-3 py-1 text-xs font-semibold text-base-content/70">{{ $feature }}</li>
                        @endforeach
                    </ul>

                    <span class="mt-auto flex items-center gap-1.5 pt-6 text-sm font-semibold text-primary">
                        {{ __('Learn more') }}
                        <i class="icon-[tabler--arrow-right] text-base transition-transform duration-300 group-hover:translate-x-1"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
