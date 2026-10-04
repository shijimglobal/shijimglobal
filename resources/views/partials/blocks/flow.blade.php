{{-- Numbered steps: a vertical timeline on phones, a horizontal track on large screens. --}}
@php $stepCount = count($block['steps']); @endphp

<section class="py-12 sm:py-16">
    <h2 class="text-center text-2xl font-extrabold tracking-tight sm:text-4xl" data-reveal>{{ $block['title'] }}</h2>

    <div class="relative mt-12">
        <div class="pointer-events-none absolute top-6 right-[8%] left-[8%] hidden h-0.5 bg-gradient-to-r from-brand-blue via-brand-indigo to-brand-violet opacity-40 lg:block" data-reveal-line></div>

        <ol @class([
            'relative grid gap-8 lg:gap-6',
            'lg:grid-cols-4' => $stepCount === 4,
            'lg:grid-cols-5' => $stepCount >= 5,
            'lg:grid-cols-3' => $stepCount <= 3,
        ])>
            @foreach ($block['steps'] as $step)
                <li class="relative flex gap-5 lg:flex-col lg:items-center lg:text-center" data-reveal style="--reveal-delay: {{ $loop->index * 250 }}ms">
                    @unless ($loop->last)
                        <span class="absolute top-12 bottom-[-2rem] left-6 w-0.5 bg-gradient-to-b from-brand-indigo/40 to-transparent lg:hidden"></span>
                    @endunless
                    <span class="relative z-10 flex size-12 shrink-0 items-center justify-center rounded-full bg-brand-gradient text-lg font-extrabold text-white shadow-lg shadow-primary/30 ring-4 ring-base-100">
                        {{ $loop->iteration }}
                    </span>
                    <div class="pt-1.5 lg:pt-0">
                        <h3 class="text-lg font-bold lg:mt-5">{{ $step['title'] }}</h3>
                        <p class="mt-1 text-sm leading-relaxed text-base-content/70">{{ $step['text'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
