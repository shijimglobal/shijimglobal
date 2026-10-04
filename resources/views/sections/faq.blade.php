@php
    $visibleFaqs = \App\Support\SiteContent::faqs();
@endphp

{{-- FAQ --}}
<section id="faq" class="bg-base-100 py-24 lg:py-32">
    <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-3 lg:px-8">
        <div data-reveal>
            <span class="text-sm font-bold tracking-widest text-primary uppercase">FAQ</span>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Frequently asked questions') }}</h2>
            <p class="mt-4 text-lg text-base-content/70">{{ __('Didn’t find your answer? Contact us directly.') }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#contact" class="btn btn-cta btn-primary btn-soft">
                    <i class="icon-[tabler--message-circle] text-lg"></i>
                    {{ __('Ask a question') }}
                </a>
            </div>
        </div>

        <div class="accordion accordion-shadow divide-y-0 space-y-4 lg:col-span-2" data-reveal>
            @foreach ($visibleFaqs as $faq)
                <div class="accordion-item rounded-2xl! border border-base-300 bg-base-100 {{ $loop->first ? 'active' : '' }}" id="faq-{{ $loop->iteration }}">
                    <button type="button" class="accordion-toggle inline-flex w-full items-center justify-between gap-x-4 px-6 py-5 text-start text-base font-semibold" aria-controls="faq-{{ $loop->iteration }}-collapse" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $faq['question'] }}
                        <i class="icon-[tabler--chevron-down] shrink-0 text-xl text-primary transition-transform duration-300 accordion-item-active:rotate-180"></i>
                    </button>
                    <div id="faq-{{ $loop->iteration }}-collapse" class="accordion-content w-full overflow-hidden transition-[height] duration-300 {{ $loop->first ? '' : 'hidden' }}" aria-labelledby="faq-{{ $loop->iteration }}" role="region">
                        <p class="px-6 pb-5 leading-relaxed text-base-content/70">{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
