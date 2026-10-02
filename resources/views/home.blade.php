@extends('layouts.app')

@php
    $services = [
        [
            'icon' => 'icon-[tabler--world-www]',
            'title' => __('Company website'),
            'description' => __('A modern, fast and SEO-friendly website that presents your organization, brand and products professionally.'),
            'features' => [__('Responsive design'), __('Content management'), __('SEO setup')],
            'class' => 'lg:col-span-2',
        ],
        [
            'icon' => 'icon-[tabler--credit-card-pay]',
            'title' => __('Online payments'),
            'description' => __('We securely and reliably connect bank, QR and card payment solutions to your system.'),
            'features' => [__('QR payments'), __('Card payments'), __('Automatic confirmation')],
            'class' => '',
        ],
        [
            'icon' => 'icon-[tabler--shopping-bag]',
            'title' => 'E-commerce',
            'description' => __('A full-featured online store to manage products, orders, delivery and inventory in one place.'),
            'features' => [__('Order management'), __('Inventory tracking'), __('Reports & analytics')],
            'class' => '',
        ],
        [
            'icon' => 'icon-[tabler--server-cog]',
            'title' => __('Server setup'),
            'description' => __('Professional server installation, security, domain, SSL, backup and monitoring configuration.'),
            'features' => [__('SSL & security'), __('Automatic backups'), __('Monitoring')],
            'class' => '',
        ],
        [
            'icon' => 'icon-[tabler--cloud-computing]',
            'title' => __('Server rental'),
            'description' => __('Rent servers sized to your business needs on flexible terms at an affordable price.'),
            'features' => [__('Flexible plans'), __('Scalable'), __('Technical support')],
            'class' => '',
        ],
    ];

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

    $processSteps = [
        ['icon' => 'icon-[tabler--message-chatbot]', 'title' => __('Consultation'), 'description' => __('We listen to your business goals and needs to define the right solution.')],
        ['icon' => 'icon-[tabler--layout-dashboard]', 'title' => __('Design'), 'description' => __('We craft the UI/UX design and approve it together with you.')],
        ['icon' => 'icon-[tabler--code]', 'title' => __('Development'), 'description' => __('We build with modern technology and run quality checks.')],
        ['icon' => 'icon-[tabler--rocket]', 'title' => __('Launch'), 'description' => __('We deploy to the server, go live and keep supporting you.')],
    ];

    $faqs = [
        ['question' => __('How long does it take to build a website?'), 'answer' => __('A company website usually takes 2–4 weeks, while e-commerce and payment-enabled systems take 4–8 weeks depending on requirements.')],
        ['question' => __('How do I get a quote?'), 'answer' => __('Send a request using the form below. Our team will contact you, clarify your needs and then send a quote.')],
        ['question' => __('What are the terms for server rental?'), 'answer' => __('We offer flexible monthly and yearly plans, and capacity can easily be increased as your needs grow.')],
        ['question' => __('Do you provide support after launch?'), 'answer' => __('Yes. We continue to provide maintenance, updates and technical advice.')],
        ['question' => __('Can you redesign my existing website?'), 'answer' => __('Yes. We review your current system and propose ways to improve its design and performance.')],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-base-200 pt-36 pb-24 lg:pt-44 lg:pb-32">
        <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_top,black_30%,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-32 -right-32 size-[34rem] glow-brand-indigo/35"></div>
        <div class="pointer-events-none absolute top-1/2 -left-40 size-[28rem] glow-brand-blue/35"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-16 px-4 lg:grid-cols-2 lg:px-8">
            <div>
                <span class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-base-100 px-4 py-1.5 text-sm font-semibold text-primary shadow-sm">
                    <span class="size-2 animate-pulse rounded-full bg-primary"></span>
                    {{ __('Your digital solutions partner') }}
                </span>

                <h1 class="mt-6 text-4xl leading-tight font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                    <span class="text-gradient">{{ __('More opportunities,') }}</span><br>
                    {{ __('lower costs') }}
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-relaxed text-base-content/70">
                    {{ __('We take your business to the next level with company websites, online payments, e-commerce, server setup and server rental.') }}
                </p>

                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#contact" class="btn btn-cta border-0 bg-brand-gradient text-white shadow-xl shadow-primary/30 hover:opacity-90">
                        {{ __('Get a quote') }}
                        <i class="icon-[tabler--arrow-right] text-lg"></i>
                    </a>
                    <a href="#services" class="btn btn-cta btn-outline border-base-300 bg-base-100 hover:border-primary hover:bg-primary/5 hover:text-primary">
                        <i class="icon-[tabler--layout-grid] text-lg"></i>
                        {{ __('View services') }}
                    </a>
                </div>

                <ul class="mt-10 flex flex-wrap gap-x-6 gap-y-3 text-sm font-medium text-base-content/70">
                    <li class="flex items-center gap-2"><i class="icon-[tabler--circle-check-filled] text-lg text-success"></i> {{ __('Flexible pricing') }}</li>
                    <li class="flex items-center gap-2"><i class="icon-[tabler--circle-check-filled] text-lg text-success"></i> {{ __('Modern UI/UX') }}</li>
                    <li class="flex items-center gap-2"><i class="icon-[tabler--circle-check-filled] text-lg text-success"></i> {{ __('Ongoing support') }}</li>
                </ul>
            </div>

            {{-- Hero visual --}}
            <div class="relative mx-auto w-full max-w-lg">
                <x-logo-mark aria-hidden="true" class="animate-spin-slow pointer-events-none absolute -top-16 -right-10 size-48 opacity-10" />

                <div class="relative rounded-3xl border border-base-300 bg-base-100 p-3 shadow-2xl shadow-primary/15">
                    <div class="flex items-center gap-2 px-3 py-2">
                        <span class="size-3 rounded-full bg-error/70"></span>
                        <span class="size-3 rounded-full bg-warning/70"></span>
                        <span class="size-3 rounded-full bg-success/70"></span>
                        <div class="ms-3 flex flex-1 items-center gap-2 rounded-lg bg-base-200 px-3 py-1.5 text-xs text-base-content/50">
                            <i class="icon-[tabler--lock] text-success"></i> {{ __('your-business.mn') }}
                        </div>
                    </div>

                    <div class="rounded-2xl bg-base-200 p-5">
                        <div class="rounded-2xl bg-brand-gradient p-6 text-white">
                            <p class="text-sm text-white/70">{{ __('Today’s sales') }}</p>
                            <p class="mt-1 text-3xl font-bold">₮ 4,820,000</p>
                            <div class="mt-5 flex h-16 items-end gap-2">
                                @foreach ([40, 65, 45, 80, 55, 90, 70, 100] as $barHeight)
                                    <div class="flex-1 rounded-t-md bg-white/30" style="height: {{ $barHeight }}%"></div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div class="rounded-2xl bg-base-100 p-4">
                                <i class="icon-[tabler--shopping-cart] text-2xl text-secondary"></i>
                                <p class="mt-2 text-xs text-base-content/60">{{ __('Orders') }}</p>
                                <p class="text-lg font-bold">128</p>
                            </div>
                            <div class="rounded-2xl bg-base-100 p-4">
                                <i class="icon-[tabler--users] text-2xl text-primary"></i>
                                <p class="mt-2 text-xs text-base-content/60">{{ __('Visitors') }}</p>
                                <p class="text-lg font-bold">2,340</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="animate-float absolute -bottom-8 -left-6 flex items-center gap-3 rounded-2xl border border-base-300 bg-base-100 p-4 shadow-xl sm:-left-12">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-success/15 text-success">
                        <i class="icon-[tabler--qrcode] text-2xl"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold">{{ __('Payment successful') }}</p>
                        <p class="text-xs text-base-content/60">QR · ₮ 89,000</p>
                    </div>
                </div>

                <div class="animate-float absolute -top-6 -right-4 flex items-center gap-3 rounded-2xl border border-base-300 bg-base-100 p-4 shadow-xl [animation-delay:-3s] sm:-right-10">
                    <span class="flex size-11 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="icon-[tabler--server-2] text-2xl"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold">{{ __('Server online') }}</p>
                        <p class="flex items-center gap-1 text-xs text-base-content/60"><span class="size-1.5 rounded-full bg-success"></span> {{ __('Running normally') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Partners --}}
    <x-partners />

    {{-- Services --}}
    <section id="services" class="py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <div class="mx-auto max-w-2xl text-center" data-reveal>
                <span class="text-sm font-bold tracking-widest text-primary uppercase">{{ __('Services') }}</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Digital solutions for your business') }}</h2>
                <p class="mt-4 text-lg text-base-content/70">{{ __('Everything from websites to server infrastructure, in one place.') }}</p>
            </div>

            <div class="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $service)
                    <article class="group relative overflow-hidden rounded-3xl border border-base-300 bg-base-100 p-8 transition duration-300 hover:-translate-y-1 hover:border-primary/40 hover:shadow-2xl hover:shadow-primary/10 {{ $service['class'] }}" data-reveal>
                        <div class="pointer-events-none absolute -top-20 -right-20 size-48 glow-primary/20 opacity-0 transition group-hover:opacity-100"></div>

                        <span class="flex size-14 items-center justify-center rounded-2xl bg-brand-gradient text-white shadow-lg shadow-primary/25">
                            <i class="{{ $service['icon'] }} text-3xl"></i>
                        </span>

                        <h3 class="mt-6 text-xl font-bold">{{ $service['title'] }}</h3>
                        <p class="mt-3 leading-relaxed text-base-content/70">{{ $service['description'] }}</p>

                        <ul class="mt-6 flex flex-wrap gap-2">
                            @foreach ($service['features'] as $feature)
                                <li class="rounded-full bg-base-200 px-3 py-1 text-xs font-semibold text-base-content/70">{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

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

    {{-- Process --}}
    <section id="process" class="py-24 lg:py-32">
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

    {{-- FAQ --}}
    <section id="faq" class="bg-base-200 py-24 lg:py-32">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 lg:grid-cols-3 lg:px-8">
            <div data-reveal>
                <span class="text-sm font-bold tracking-widest text-primary uppercase">FAQ</span>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight sm:text-4xl">{{ __('Frequently asked questions') }}</h2>
                <p class="mt-4 text-lg text-base-content/70">{{ __('Didn’t find your answer? Contact us directly.') }}</p>
                <a href="#contact" class="btn btn-cta btn-primary btn-soft mt-8">
                    <i class="icon-[tabler--message-circle] text-lg"></i>
                    {{ __('Ask a question') }}
                </a>
            </div>

            <div class="accordion accordion-shadow divide-y-0 space-y-4 lg:col-span-2" data-reveal>
                @foreach ($faqs as $faq)
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

    {{-- Facebook page --}}
    <x-facebook-page />

    {{-- Contact --}}
    <section id="contact" class="py-16 sm:py-24 lg:py-32">
        <div class="mx-auto max-w-7xl px-3 sm:px-4 lg:px-8">
            <div class="relative overflow-hidden rounded-3xl bg-brand-gradient px-4 py-8 shadow-2xl shadow-primary/30 sm:rounded-[2.5rem] sm:p-10 lg:p-14">
                <img src="{{ asset('assets/logo/Asset 7.png') }}" alt="" aria-hidden="true" class="animate-spin-slow pointer-events-none absolute -bottom-24 -left-24 size-96 opacity-10 brightness-0 invert">

                <div class="relative grid gap-10 lg:grid-cols-2 lg:gap-12">
                    <div class="px-2 text-white sm:px-0" data-reveal>
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide uppercase">
                            <i class="icon-[tabler--rocket] text-sm"></i>
                            {{ __('Contact') }}
                        </span>
                        <h2 class="mt-4 text-2xl leading-snug font-extrabold tracking-tight text-balance sm:text-4xl sm:leading-tight">{{ __('Are you ready to take your business to the next level?') }}</h2>
                        <p class="mt-4 text-base leading-relaxed text-white/80 sm:mt-5 sm:text-lg">
                            {{ __('Send us your request. Our team will contact you shortly with a free consultation.') }}
                        </p>

                        <ul class="mt-8 space-y-3 sm:mt-10 sm:space-y-4">
                            <li>
                                <a href="mailto:{{ config('company.email') }}" class="flex items-center gap-4 rounded-2xl bg-white/10 p-4 transition hover:bg-white/20">
                                    <span class="flex size-11 items-center justify-center rounded-xl bg-white text-primary"><i class="icon-[tabler--mail] text-2xl"></i></span>
                                    <span>
                                        <span class="block text-sm text-white/70">{{ __('Email') }}</span>
                                        <span class="font-semibold">{{ config('company.email') }}</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{ str_replace(' ', '', config('company.phone')) }}" class="flex items-center gap-4 rounded-2xl bg-white/10 p-4 transition hover:bg-white/20">
                                    <span class="flex size-11 items-center justify-center rounded-xl bg-white text-primary"><i class="icon-[tabler--phone] text-2xl"></i></span>
                                    <span>
                                        <span class="block text-sm text-white/70">{{ __('Phone') }}</span>
                                        <span class="font-semibold">{{ config('company.phone') }}</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('contact.store') }}" class="rounded-3xl border border-base-300/60 bg-base-100 p-5 shadow-2xl sm:p-8" data-reveal>
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-soft alert-success mb-6 flex items-center gap-3 rounded-2xl" role="alert">
                                <i class="icon-[tabler--circle-check] text-2xl"></i>
                                <span>{{ session('status') }}</span>
                            </div>
                        @endif

                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="field-label" for="name">{{ __('Name') }} <span class="text-error">*</span></label>
                                <div class="relative">
                                    <i class="icon-[tabler--user] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Your name') }}" class="input field-shell ps-12 @error('name') is-invalid @enderror" autocomplete="name" required>
                                </div>
                                @error('name')
                                    <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="field-label" for="phone">{{ __('Phone') }} <span class="text-error">*</span></label>
                                <div class="relative">
                                    <i class="icon-[tabler--phone] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="9911 2233" class="input field-shell ps-12 @error('phone') is-invalid @enderror" autocomplete="tel" required>
                                </div>
                                @error('phone')
                                    <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="field-label" for="email">{{ __('Email') }}</label>
                                <div class="relative">
                                    <i class="icon-[tabler--mail] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.mn" class="input field-shell ps-12 @error('email') is-invalid @enderror" autocomplete="email">
                                </div>
                                @error('email')
                                    <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                @php
                                    $serviceIcons = [
                                        'Company website' => 'icon-[tabler--world-www]',
                                        'Online payments' => 'icon-[tabler--credit-card-pay]',
                                        'E-commerce' => 'icon-[tabler--shopping-bag]',
                                        'Server setup' => 'icon-[tabler--server-cog]',
                                        'Server rental' => 'icon-[tabler--cloud-computing]',
                                        'Other' => 'icon-[tabler--dots]',
                                    ];

                                    $serviceSelectConfig = [
                                        'placeholder' => __('Select a service'),
                                        'toggleTag' => '<button type="button" aria-expanded="false"><span class="truncate" data-title></span></button>',
                                        'toggleClasses' => 'advance-select-toggle field-shell flex items-center ps-12 pe-11 text-start'.($errors->has('service') ? ' is-invalid' : ''),
                                        'dropdownClasses' => 'advance-select-menu mt-2 max-h-80 space-y-1 overflow-y-auto rounded-2xl border border-base-300 bg-base-100 p-2 shadow-2xl shadow-primary/10',
                                        'optionClasses' => 'advance-select-option group flex items-center rounded-xl px-3 py-2.5 transition hover:bg-primary/5 selected:bg-primary/10 selected:font-semibold selected:text-primary',
                                        'optionTemplate' => '<div class="flex w-full items-center gap-3"><span class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-base-200 text-lg text-base-content/60 transition group-hover:text-primary" data-icon></span><span class="grow" data-title></span><i class="icon-[tabler--check] hidden shrink-0 text-lg text-primary selected:block"></i></div>',
                                        'extraMarkup' => '<i class="icon-[tabler--chevron-down] pointer-events-none absolute end-4 top-1/2 -translate-y-1/2 text-lg text-base-content/50"></i>',
                                    ];
                                @endphp

                                <label class="field-label" for="service">{{ __('Service') }} <span class="text-error">*</span></label>
                                <div class="relative">
                                    <i class="icon-[tabler--apps] pointer-events-none absolute top-1/2 left-4 z-20 -translate-y-1/2 text-xl text-base-content/40"></i>
                                    <select id="service" name="service" class="hidden" data-select="{{ json_encode($serviceSelectConfig) }}">
                                        <option value="">{{ __('Select a service') }}</option>
                                        @foreach (\App\Http\Requests\StoreContactRequest::SERVICES as $serviceOption)
                                            <option value="{{ $serviceOption }}" data-select-option="{{ json_encode(['icon' => '<i class="'.$serviceIcons[$serviceOption].'"></i>']) }}" @selected(old('service') === $serviceOption)>{{ __($serviceOption) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('service')
                                    <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label class="field-label" for="message">{{ __('Message') }} <span class="text-error">*</span></label>
                                <textarea id="message" name="message" rows="4" placeholder="{{ __('Briefly describe your project') }}" class="textarea field-shell h-auto! min-h-32 resize-y px-4 py-3.5 @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-cta btn-block mt-7 border-0 bg-brand-gradient text-white shadow-lg shadow-primary/30 hover:opacity-90">
                            {{ __('Send request') }}
                            <i class="icon-[tabler--send] text-lg"></i>
                        </button>

                        <p class="mt-4 flex items-center justify-center gap-2 text-center text-sm text-base-content/55">
                            <i class="icon-[tabler--clock] text-base"></i>
                            {{ __('We usually reply within one business day.') }}
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
