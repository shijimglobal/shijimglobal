@php
    $moreOpportunities = [
        ['icon' => 'icon-[tabler--world-www]', 'title' => __('Online sales 24/7'), 'description' => __('Accept orders and payments even while your business rests.')],
        ['icon' => 'icon-[tabler--arrows-maximize]', 'title' => __('Built for growth'), 'description' => __('Your system scales together with your business.')],
        ['icon' => 'icon-[tabler--device-mobile]', 'title' => __('On every device'), 'description' => __('Works flawlessly on phones, tablets and computers.')],
        ['icon' => 'icon-[tabler--plug-connected]', 'title' => __('Integrated solution'), 'description' => __('Web, payments and servers — all connected in one place.')],
    ];

    $lowerCosts = [
        ['icon' => 'icon-[tabler--receipt-off]', 'title' => __('No hidden fees'), 'description' => __('Transparent pricing, clear contracts, no surprise costs.')],
        ['icon' => 'icon-[tabler--server-bolt]', 'title' => __('Cost-effective servers'), 'description' => __('Pay only for the capacity you actually need.')],
        ['icon' => 'icon-[tabler--clock-bolt]', 'title' => __('Time-saving delivery'), 'description' => __('A staged workflow means we deliver on time.')],
        ['icon' => 'icon-[tabler--tool]', 'title' => __('Maintenance included'), 'description' => __('No need to hire extra specialists.')],
    ];

    $pillars = [
        ['icon' => 'icon-[tabler--stack-2]', 'title' => __('All in one'), 'description' => __('From design to server')],
        ['icon' => 'icon-[tabler--shield-lock]', 'title' => __('Reliable'), 'description' => __('SSL, backups, monitoring')],
        ['icon' => 'icon-[tabler--headset]', 'title' => __('Supported'), 'description' => __('Even after launch')],
    ];
@endphp

{{-- Why us --}}
<section id="why-us" class="relative overflow-hidden bg-base-200 py-24 lg:py-32">
    <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_center,black_20%,transparent_70%)]"></div>

    <div class="relative mx-auto max-w-7xl px-4 lg:px-8">
        <div class="mx-auto max-w-2xl text-center" data-reveal>
            <span class="text-sm font-bold tracking-widest text-primary uppercase">{{ __('Advantages') }}</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">
                {!! __('Add :opportunity, subtract :cost', ['opportunity' => '<span class="text-gradient">'.e(__('opportunity')).'</span>', 'cost' => '<span class="text-gradient">'.e(__('cost')).'</span>']) !!}
            </h2>
            <p class="mt-4 text-lg text-base-content/70">{{ __('Every solution we build rests on these two principles.') }}</p>
        </div>

        <div class="mt-16 grid items-center gap-8 lg:grid-cols-[1fr_auto_1fr]">
            {{-- More opportunities --}}
            <div class="rounded-[2rem] border border-base-300 bg-base-100 p-6 shadow-xl shadow-secondary/5 sm:p-8" data-reveal>
                <div class="flex items-center gap-4">
                    <span class="flex size-14 items-center justify-center rounded-2xl bg-secondary text-white shadow-lg shadow-secondary/30">
                        <i class="icon-[tabler--plus] text-3xl"></i>
                    </span>
                    <div>
                        <p class="text-xs font-bold tracking-widest text-secondary uppercase">{{ __('You gain') }}</p>
                        <h3 class="text-2xl font-extrabold">{{ __('More opportunities') }}</h3>
                    </div>
                </div>

                <ul class="mt-8 space-y-2">
                    @foreach ($moreOpportunities as $opportunity)
                        <li class="group flex gap-4 rounded-2xl p-3 transition hover:bg-secondary/5">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-secondary/10 text-secondary transition group-hover:bg-secondary group-hover:text-white">
                                <i class="{{ $opportunity['icon'] }} text-2xl"></i>
                            </span>
                            <div>
                                <p class="font-bold">{{ $opportunity['title'] }}</p>
                                <p class="text-sm leading-relaxed text-base-content/65">{{ $opportunity['description'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Brand hub --}}
            <div class="relative mx-auto flex flex-col items-center" data-reveal>
                <div class="hidden h-16 w-px bg-gradient-to-b from-transparent to-brand-indigo/40 lg:block"></div>
                <div class="relative flex size-36 items-center justify-center">
                    <div class="animate-spin-slow absolute inset-0 rounded-full border-2 border-dashed border-brand-indigo/30"></div>
                    <div class="absolute inset-4 glow-brand-indigo/40"></div>
                    <div class="relative flex size-24 items-center justify-center rounded-full bg-base-100 shadow-2xl shadow-primary/25">
                        <x-logo-mark :alt="__(config('company.name'))" class="size-14" />
                    </div>
                    <span class="absolute top-1/2 -left-3 hidden size-8 -translate-y-1/2 items-center justify-center rounded-full bg-secondary text-white shadow-lg lg:flex"><i class="icon-[tabler--chevron-left]"></i></span>
                    <span class="absolute top-1/2 -right-3 hidden size-8 -translate-y-1/2 items-center justify-center rounded-full bg-accent text-white shadow-lg lg:flex"><i class="icon-[tabler--chevron-right]"></i></span>
                </div>
                <div class="hidden h-16 w-px bg-gradient-to-t from-transparent to-brand-indigo/40 lg:block"></div>
            </div>

            {{-- Lower costs --}}
            <div class="rounded-[2rem] border border-base-300 bg-base-100 p-6 shadow-xl shadow-accent/5 sm:p-8" data-reveal>
                <div class="flex items-center gap-4">
                    <span class="flex size-14 items-center justify-center rounded-2xl bg-accent text-white shadow-lg shadow-accent/30">
                        <i class="icon-[tabler--minus] text-3xl"></i>
                    </span>
                    <div>
                        <p class="text-xs font-bold tracking-widest text-accent uppercase">{{ __('You save') }}</p>
                        <h3 class="text-2xl font-extrabold">{{ __('Lower costs') }}</h3>
                    </div>
                </div>

                <ul class="mt-8 space-y-2">
                    @foreach ($lowerCosts as $costSaving)
                        <li class="group flex gap-4 rounded-2xl p-3 transition hover:bg-accent/5">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-accent/10 text-accent transition group-hover:bg-accent group-hover:text-white">
                                <i class="{{ $costSaving['icon'] }} text-2xl"></i>
                            </span>
                            <div>
                                <p class="font-bold">{{ $costSaving['title'] }}</p>
                                <p class="text-sm leading-relaxed text-base-content/65">{{ $costSaving['description'] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Pillars --}}
        <div class="mt-12 grid overflow-hidden rounded-[2rem] bg-brand-gradient text-white shadow-2xl shadow-primary/25 sm:grid-cols-3" data-reveal>
            @foreach ($pillars as $pillar)
                <div class="flex items-center gap-4 p-6 sm:p-8 {{ $loop->last ? '' : 'border-white/15 max-sm:border-b sm:border-e' }}">
                    <span class="flex size-12 shrink-0 items-center justify-center rounded-2xl bg-white/15">
                        <i class="{{ $pillar['icon'] }} text-2xl"></i>
                    </span>
                    <div>
                        <p class="text-lg font-bold">{{ $pillar['title'] }}</p>
                        <p class="text-sm text-white/75">{{ $pillar['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
