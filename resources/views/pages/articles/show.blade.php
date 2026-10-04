@extends('layouts.app')

@section('content')
    {{-- Article header: centred title over a large faded watermark, like a social media infographic --}}
    <header class="relative overflow-hidden bg-base-200 pt-32 pb-16 sm:pt-40 sm:pb-24">
        <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_center,black_20%,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-32 -left-32 size-[28rem] glow-brand-blue/25"></div>
        <div class="pointer-events-none absolute -right-32 -bottom-32 size-[28rem] glow-brand-violet/25"></div>
        <p class="pointer-events-none absolute inset-x-0 top-1/2 -translate-y-1/2 text-center text-[22vw] leading-none font-extrabold tracking-tighter text-base-content/[0.04] select-none sm:text-[14rem]" aria-hidden="true">{{ $article['watermark'] }}</p>

        <div class="relative mx-auto max-w-4xl px-4 text-center">
            <nav aria-label="{{ __('Breadcrumb') }}" class="flex justify-center">
                <ol class="flex flex-wrap items-center gap-1.5 text-sm text-base-content/55">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">{{ __('Home') }}</a></li>
                    <li class="flex items-center gap-1.5"><i class="icon-[tabler--chevron-right] text-xs"></i><a href="{{ route('articles.index') }}" class="hover:text-primary">{{ __('Knowledge') }}</a></li>
                </ol>
            </nav>

            <span class="mx-auto mt-8 flex size-16 items-center justify-center rounded-2xl bg-brand-gradient text-white shadow-xl shadow-primary/30">
                <i class="{{ $article['icon'] }} text-4xl"></i>
            </span>
            <h1 class="mt-6 text-4xl leading-tight font-extrabold tracking-tight text-balance sm:text-6xl">{{ $article['title'] }}</h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-base-content/70 sm:text-xl">{{ $article['lead'] }}</p>
            <p class="mt-6 flex items-center justify-center gap-4 text-sm text-base-content/50">
                <span class="flex items-center gap-1.5"><i class="icon-[tabler--clock] text-base"></i>{{ $article['reading_time'] }}</span>
                <span class="flex items-center gap-1.5"><i class="icon-[tabler--calendar] text-base"></i>{{ $article['published_at'] }}</span>
            </p>
        </div>
    </header>

    {{-- Infographic blocks --}}
    <article class="mx-auto max-w-6xl px-4 py-6 sm:py-10 lg:px-8">
        @foreach ($article['blocks'] as $block)
            @include('partials.blocks.'.$block['type'], ['block' => $block])
        @endforeach    </article>

    {{-- Related service and more articles --}}
    <section class="border-t border-base-300/60 bg-base-200/50 py-16 sm:py-20">
        <div class="mx-auto max-w-6xl space-y-14 px-4 lg:px-8">
            @if ($relatedService)
                {{-- Related service: gradient banner --}}
                <div class="relative overflow-hidden rounded-3xl bg-brand-gradient p-6 text-white shadow-xl shadow-primary/20 sm:p-10" data-reveal>
                    <div class="bg-grid pointer-events-none absolute inset-0 opacity-30 invert"></div>
                    <i class="{{ $relatedService['icon'] }} pointer-events-none absolute -right-6 -bottom-10 text-[11rem] text-white/10" aria-hidden="true"></i>

                    <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                        <div class="flex items-start gap-5">
                            <span class="flex size-14 shrink-0 items-center justify-center rounded-2xl bg-white/15 ring-1 ring-white/25">
                                <i class="{{ $relatedService['icon'] }} text-3xl"></i>
                            </span>
                            <div class="max-w-xl">
                                <span class="text-xs font-bold tracking-widest text-white/70 uppercase">{{ __('Related service') }}</span>
                                <h2 class="mt-1 text-2xl font-extrabold tracking-tight">{{ $relatedService['title'] }}</h2>
                                <p class="mt-2 text-sm leading-relaxed text-white/80 sm:text-base">{{ $relatedService['summary'] }}</p>
                            </div>
                        </div>

                        <div class="flex shrink-0 flex-wrap gap-3">
                            <a href="{{ $relatedService['url'] }}" class="btn btn-cta border-0 bg-white text-primary hover:bg-white/90">
                                {{ __('Learn more') }}
                                <i class="icon-[tabler--arrow-right] text-lg"></i>
                            </a>
                            <a href="#contact" class="btn btn-cta border border-white/40 bg-transparent text-white hover:bg-white/10">
                                {{ __('Get a quote') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- More articles --}}
            <div>
                <div class="flex items-end justify-between gap-4" data-reveal>
                    <h2 class="text-2xl font-extrabold tracking-tight">{{ __('More articles') }}</h2>
                    <a href="{{ route('articles.index') }}" class="group flex items-center gap-1.5 text-sm font-semibold text-primary">
                        {{ __('All articles') }}
                        <i class="icon-[tabler--arrow-right] transition-transform duration-300 group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    @foreach ($otherArticles as $otherArticle)
                        <a href="{{ $otherArticle['url'] }}" class="group flex items-center gap-5 rounded-3xl border border-base-300/70 bg-base-100 p-4 transition duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10 sm:p-5" data-reveal style="--reveal-delay: {{ $loop->index * 120 }}ms">
                            {{-- Thumbnail: stacked tiles like the knowledge cards --}}
                            <span class="relative flex size-24 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-br from-brand-blue/10 via-base-200 to-brand-violet/15 sm:size-28">
                                <span class="bg-grid pointer-events-none absolute inset-0 opacity-70"></span>
                                <span class="relative">
                                    <span class="absolute inset-0 translate-x-1.5 translate-y-1.5 rounded-xl bg-brand-indigo/40"></span>
                                    <span class="relative flex size-12 items-center justify-center rounded-xl bg-brand-gradient text-white shadow-lg shadow-primary/30 transition duration-500 group-hover:-translate-y-0.5 group-hover:rotate-3">
                                        <i class="{{ $otherArticle['icon'] }} text-2xl"></i>
                                    </span>
                                </span>
                            </span>

                            <span class="min-w-0 flex-1">
                                <span class="flex items-center gap-1.5 text-xs font-semibold text-base-content/50">
                                    <i class="icon-[tabler--clock] text-sm"></i>
                                    {{ $otherArticle['reading_time'] }}
                                </span>
                                <span class="mt-1 block text-lg leading-snug font-bold">{{ $otherArticle['title'] }}</span>
                                <span class="mt-1 line-clamp-2 block text-sm text-base-content/65">{{ $otherArticle['lead'] }}</span>
                            </span>

                            <span class="hidden size-10 shrink-0 items-center justify-center rounded-full bg-base-200 text-base-content/50 transition group-hover:bg-brand-gradient group-hover:text-white sm:flex">
                                <i class="icon-[tabler--arrow-up-right] text-lg"></i>
                            </span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('sections.contact', ['preselectedService' => $relatedService['contact_service'] ?? null])
@endsection
