@extends('layouts.app')

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-base-200 pt-36 pb-24 lg:pt-44 lg:pb-32">
        <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_top,black_30%,transparent_75%)]"></div>
        <div class="pointer-events-none absolute -top-32 -right-32 size-[34rem] glow-brand-indigo/35"></div>
        <div class="pointer-events-none absolute top-1/2 -left-40 size-[28rem] glow-brand-blue/35"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-16 px-4 lg:grid-cols-2 lg:px-8">
            <div>
                {{-- One H1 holds both the search keywords (badge) and the slogan. --}}
                <h1>
                    <span class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-base-100 px-4 py-1.5 text-sm font-semibold text-primary shadow-sm">
                        <span class="size-2 animate-pulse rounded-full bg-primary"></span>
                        {{ __('Website development service') }}
                    </span>

                    <span class="mt-6 block text-4xl leading-tight font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                        <span class="text-gradient">{{ __('More opportunities,') }}</span><br>
                        {{ __('lower costs') }}
                    </span>
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

    @include('sections.services')

    @include('sections.why-us')

    @include('sections.process')

    @include('sections.knowledge')

    @include('sections.faq')

    {{-- Facebook page --}}
    <x-facebook-page />

    @include('sections.contact')
@endsection
