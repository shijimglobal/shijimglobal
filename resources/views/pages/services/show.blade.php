@extends('layouts.app')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => __('Services'),
        'heading' => $service['title'],
        'lead' => $service['tagline'],
        'icon' => $service['icon'],
        'breadcrumbs' => [[__('Services'), route('home').'#services'], [$service['title'], null]],
        'backUrl' => route('home').'#services',
    ])

    {{-- Intro and who it is for --}}
    <section class="py-16 sm:py-20">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 lg:grid-cols-3 lg:px-8">
            <div class="lg:col-span-2" data-reveal>
                <p class="max-w-2xl text-base leading-relaxed text-base-content/75 sm:text-lg">{{ $service['intro'] }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#contact" class="btn btn-cta border-0 bg-brand-gradient text-white shadow-lg shadow-primary/30 hover:opacity-90">
                        {{ __('Get a quote') }}
                        <i class="icon-[tabler--arrow-right] text-lg"></i>
                    </a>
                    @if ($relatedArticle)
                        <a href="{{ $relatedArticle['url'] }}" class="btn btn-cta btn-outline border-base-300 bg-base-100 hover:border-primary hover:bg-primary/5 hover:text-primary">
                            <i class="icon-[tabler--book] text-lg"></i>
                            {{ $relatedArticle['title'] }}
                        </a>
                    @endif
                </div>
            </div>

            <aside class="rounded-3xl border border-base-300/70 bg-base-200/60 p-6 sm:p-8" data-reveal>
                <h2 class="flex items-center gap-2 font-bold">
                    <i class="icon-[tabler--target-arrow] text-xl text-primary"></i>
                    {{ __('Ideal for') }}
                </h2>
                <ul class="mt-5 space-y-3">
                    @foreach ($service['ideal_for'] as $audience)
                        <li class="flex gap-3 text-base-content/80">
                            <i class="icon-[tabler--circle-check-filled] mt-0.5 shrink-0 text-lg text-success"></i>
                            {{ $audience }}
                        </li>
                    @endforeach
                </ul>
            </aside>
        </div>
    </section>

    {{-- What is included --}}
    <section class="bg-base-200 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <h2 class="text-center text-2xl font-extrabold tracking-tight sm:text-4xl" data-reveal>{{ __('What is included') }}</h2>
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($service['includes'] as $included)
                    <div class="group rounded-3xl border border-base-300/70 bg-base-100 p-6 transition hover:-translate-y-1 hover:border-primary/40 hover:shadow-xl hover:shadow-primary/10" data-reveal style="--reveal-delay: {{ ($loop->index % 3) * 120 }}ms">
                        <span class="flex size-12 items-center justify-center rounded-2xl bg-primary/10 text-primary transition group-hover:bg-brand-gradient group-hover:text-white">
                            <i class="{{ $included['icon'] }} text-2xl"></i>
                        </span>
                        <h3 class="mt-5 text-lg font-bold">{{ $included['title'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-base-content/70">{{ $included['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Service FAQ --}}
    <section class="py-16 sm:py-24">
        <div class="mx-auto max-w-3xl px-4">
            <h2 class="text-center text-2xl font-extrabold tracking-tight sm:text-4xl" data-reveal>{{ __('Frequently asked questions') }}</h2>
            <div class="accordion accordion-shadow mt-10 divide-y-0 space-y-4" data-reveal>
                @foreach ($service['faqs'] as $faq)
                    <div class="accordion-item rounded-2xl! border border-base-300 bg-base-100 {{ $loop->first ? 'active' : '' }}" id="service-faq-{{ $loop->iteration }}">
                        <button type="button" class="accordion-toggle inline-flex w-full items-center justify-between gap-x-4 px-6 py-5 text-start text-base font-semibold" aria-controls="service-faq-{{ $loop->iteration }}-collapse" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $faq['question'] }}
                            <i class="icon-[tabler--chevron-down] shrink-0 text-xl text-primary transition-transform duration-300 accordion-item-active:rotate-180"></i>
                        </button>
                        <div id="service-faq-{{ $loop->iteration }}-collapse" class="accordion-content w-full overflow-hidden transition-[height] duration-300 {{ $loop->first ? '' : 'hidden' }}" aria-labelledby="service-faq-{{ $loop->iteration }}" role="region">
                            <p class="px-6 pb-5 leading-relaxed text-base-content/70">{{ $faq['answer'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>        </div>
    </section>

    {{-- Other services --}}
    <section class="border-t border-base-300/60 py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <h2 class="text-xl font-bold" data-reveal>{{ __('Other services') }}</h2>
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($otherServices as $otherService)
                    <a href="{{ $otherService['url'] }}" class="group flex items-center gap-4 rounded-2xl border border-base-300/70 bg-base-100 p-4 transition hover:border-primary/40 hover:shadow-lg hover:shadow-primary/5" data-reveal>
                        <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-brand-gradient group-hover:text-white">
                            <i class="{{ $otherService['icon'] }} text-xl"></i>
                        </span>
                        <span class="font-semibold">{{ $otherService['title'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('sections.contact', ['preselectedService' => $service['contact_service']])
@endsection
