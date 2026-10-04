{{-- Grid of icon cards. --}}
<section class="py-12 sm:py-16">
    <h2 class="text-center text-2xl font-extrabold tracking-tight sm:text-4xl" data-reveal>{{ $block['title'] }}</h2>

    <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
        @foreach ($block['items'] as $item)
            <div class="group rounded-3xl border border-base-300/70 bg-base-100 p-6 transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10" data-reveal style="--reveal-delay: {{ $loop->index * 120 }}ms">
                <span class="flex size-12 items-center justify-center rounded-2xl bg-primary/10 text-primary transition group-hover:bg-brand-gradient group-hover:text-white">
                    <i class="{{ $item['icon'] }} text-2xl"></i>
                </span>
                <h3 class="mt-5 text-lg font-bold">{{ $item['title'] }}</h3>
                <p class="mt-2 text-sm leading-relaxed text-base-content/70">{{ $item['text'] }}</p>
            </div>
        @endforeach
    </div>
</section>
