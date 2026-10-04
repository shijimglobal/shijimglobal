@php $knowledgeArticles = $articles ?? \App\Support\SiteContent::articles(); @endphp

{{-- Knowledge --}}
<section id="knowledge" @class(["relative overflow-hidden py-24 lg:py-32", "bg-base-200" => $tinted ?? true])>
    <div class="mx-auto max-w-7xl px-4 lg:px-8">
        @unless ($hideHeading ?? false)
            <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end" data-reveal>
                <div class="max-w-2xl">
                    <span class="text-sm font-bold tracking-widest text-primary uppercase">{{ __('Knowledge') }}</span>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Understand it in a minute') }}</h2>
                    <p class="mt-4 text-lg text-base-content/70">{{ __('Short visual guides to the technology behind your business.') }}</p>
                </div>
                <a href="{{ route('articles.index') }}" class="btn btn-cta btn-outline shrink-0 border-base-300 bg-base-100 hover:border-primary hover:bg-primary/5 hover:text-primary">
                    {{ __('All articles') }}
                    <i class="icon-[tabler--arrow-right] text-lg"></i>
                </a>
            </div>
        @endunless

        <div @class(['grid gap-6 md:grid-cols-3', 'mt-14' => ! ($hideHeading ?? false)])>
            @foreach ($knowledgeArticles as $article)
                <a href="{{ $article['url'] }}" class="group flex flex-col overflow-hidden rounded-3xl border border-base-300 bg-base-100 transition duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10" data-reveal style="--reveal-delay: {{ $loop->index * 150 }}ms">
                    {{-- Illustration: stacked isometric-style tiles in brand colours --}}
                    <div class="relative flex h-44 items-center justify-center overflow-hidden bg-gradient-to-br from-brand-blue/10 via-base-200 to-brand-violet/15">
                        <div class="bg-grid pointer-events-none absolute inset-0 opacity-70"></div>
                        <div class="relative">
                            <span class="absolute inset-0 translate-x-3 translate-y-3 rounded-[1.75rem] bg-brand-violet/30"></span>
                            <span class="absolute inset-0 translate-x-1.5 translate-y-1.5 rounded-[1.75rem] bg-brand-indigo/40"></span>
                            <span class="relative flex size-24 items-center justify-center rounded-[1.75rem] bg-brand-gradient text-white shadow-2xl shadow-primary/30 transition duration-500 group-hover:-translate-y-1 group-hover:rotate-3">
                                <i class="{{ $article['icon'] }} text-5xl"></i>
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <span class="flex items-center gap-1.5 text-xs font-semibold text-base-content/50">
                            <i class="icon-[tabler--clock] text-sm"></i>
                            {{ $article['reading_time'] }}
                        </span>
                        <h3 class="mt-2 text-xl font-bold">{{ $article['title'] }}</h3>
                        <p class="mt-2 line-clamp-3 text-sm leading-relaxed text-base-content/70">{{ $article['lead'] }}</p>
                        <span class="mt-auto flex items-center gap-1.5 pt-5 text-sm font-semibold text-primary">
                            {{ __('Read article') }}
                            <i class="icon-[tabler--arrow-right] text-base transition-transform duration-300 group-hover:translate-x-1"></i>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
