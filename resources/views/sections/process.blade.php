@php
    $processSteps = [
        ['icon' => 'icon-[tabler--message-chatbot]', 'title' => __('Consultation'), 'description' => __('We listen to your business goals and needs to define the right solution.')],
        ['icon' => 'icon-[tabler--layout-dashboard]', 'title' => __('Design'), 'description' => __('We craft the UI/UX design and approve it together with you.')],
        ['icon' => 'icon-[tabler--code]', 'title' => __('Development'), 'description' => __('We build with modern technology and run quality checks.')],
        ['icon' => 'icon-[tabler--rocket]', 'title' => __('Launch'), 'description' => __('We deploy to the server, go live and keep supporting you.')],
    ];
@endphp

{{-- Process --}}
<section id="process" class="bg-base-200 py-24 lg:py-32">
    <div class="mx-auto max-w-7xl px-4 lg:px-8">
        <div class="mx-auto max-w-2xl text-center" data-reveal>
            <span class="text-sm font-bold tracking-widest text-primary uppercase">{{ __('Process') }}</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('From idea to working solution') }}</h2>
            <p class="mt-4 text-lg text-base-content/70">{{ __('Four clear, transparent stages.') }}</p>
        </div>

        <div class="relative mt-16">
        <div class="pointer-events-none absolute top-10 right-[12%] left-[12%] hidden h-0.5 bg-gradient-to-r from-brand-blue via-brand-indigo to-brand-violet opacity-30 lg:block" data-reveal-line></div>
        <ol class="relative grid gap-6 md:grid-cols-2 lg:grid-cols-4">

            @foreach ($processSteps as $processStep)
                {{-- Steps appear one after another, following the line as it draws. --}}
                <li class="relative text-center" data-reveal style="--reveal-delay: {{ $loop->index * 350 }}ms">
                    <div class="relative mx-auto flex size-20 items-center justify-center rounded-3xl border border-base-300 bg-base-100 shadow-lg shadow-primary/10">
                        <i class="{{ $processStep['icon'] }} icon-gradient text-4xl"></i>
                        <span class="absolute -top-2 -right-2 flex size-7 items-center justify-center rounded-full bg-brand-gradient text-xs font-bold text-white">
                            {{ $loop->iteration }}
                        </span>
                    </div>
                    <h3 class="mt-6 text-lg font-bold">{{ $processStep['title'] }}</h3>
                    <p class="mx-auto mt-2 max-w-xs text-sm leading-relaxed text-base-content/70">{{ $processStep['description'] }}</p>
                </li>
            @endforeach
        </ol>
        </div>
    </div>
</section>
