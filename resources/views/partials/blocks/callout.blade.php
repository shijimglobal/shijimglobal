{{-- Big statement: small kicker, huge headline, divider, bullet text and a stacked-tile illustration. --}}
<section class="py-12 sm:py-16" data-reveal>
    <div class="relative grid items-center gap-10 overflow-hidden rounded-[2rem] border border-base-300/70 bg-gradient-to-br from-base-200/80 via-base-100 to-brand-indigo/[0.07] p-8 sm:p-12 lg:grid-cols-[1.3fr_1fr]">
        <div class="pointer-events-none absolute -right-20 -bottom-24 size-96 glow-brand-indigo/25"></div>

        <div class="relative">
            <p class="text-lg text-base-content/70 sm:text-xl">{{ $block['kicker'] }}</p>
            <p class="mt-1 text-4xl leading-none font-extrabold tracking-tight sm:text-6xl">{{ $block['headline'] }}</p>
            <div class="mt-6 h-0.5 w-full max-w-lg bg-gradient-to-r from-brand-indigo to-transparent"></div>
            <p class="mt-6 flex max-w-lg gap-4 text-lg leading-relaxed text-base-content/80">
                <span class="mt-2 size-3.5 shrink-0 rounded-full bg-brand-indigo"></span>
                {{ $block['text'] }}
            </p>
        </div>

        <div class="relative mx-auto flex size-56 items-center justify-center sm:size-64" aria-hidden="true">
            <span class="absolute size-40 translate-x-6 translate-y-6 rotate-6 rounded-[2.5rem] bg-brand-violet/25 sm:size-44"></span>
            <span class="absolute size-40 translate-x-3 translate-y-3 rotate-3 rounded-[2.5rem] bg-brand-indigo/40 sm:size-44"></span>
            <span class="animate-float relative flex size-40 items-center justify-center rounded-[2.5rem] bg-brand-gradient text-white shadow-2xl shadow-primary/40 sm:size-44">
                <i class="{{ $block['icon'] }} text-7xl sm:text-8xl"></i>
            </span>
        </div>
    </div>
</section>
