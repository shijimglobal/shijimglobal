{{--
    Page header with breadcrumbs.
    Expects: $heading, optional $eyebrow, $lead, $icon, $breadcrumbs (list of [label, url]).
--}}
<section class="relative overflow-hidden bg-base-200 pt-32 pb-14 sm:pt-40 sm:pb-20">
    <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_top,black_20%,transparent_70%)]"></div>
    <div class="pointer-events-none absolute -top-32 -right-32 size-[30rem] glow-brand-indigo/30"></div>

    <div class="relative mx-auto max-w-7xl px-4 lg:px-8">
        <nav aria-label="{{ __('Breadcrumb') }}">
            <ol class="flex flex-wrap items-center gap-1.5 text-sm text-base-content/55">
                <li><a href="{{ route('home') }}" class="hover:text-primary">{{ __('Home') }}</a></li>
                @foreach ($breadcrumbs ?? [] as [$crumbLabel, $crumbUrl])
                    <li class="flex items-center gap-1.5">
                        <i class="icon-[tabler--chevron-right] text-xs"></i>
                        @if ($crumbUrl)
                            <a href="{{ $crumbUrl }}" class="hover:text-primary">{{ $crumbLabel }}</a>
                        @else
                            <span class="font-semibold text-base-content/80" aria-current="page">{{ $crumbLabel }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        <div class="mt-8 flex flex-col gap-6 sm:flex-row sm:items-center">
            @isset($icon)
                <span class="flex size-16 shrink-0 items-center justify-center rounded-2xl bg-brand-gradient text-white shadow-xl shadow-primary/30">
                    <i class="{{ $icon }} text-4xl"></i>
                </span>
            @endisset
            <div>
                @isset($eyebrow)
                    <span class="text-sm font-bold tracking-widest text-primary uppercase">{{ $eyebrow }}</span>
                @endisset
                <h1 class="mt-1 text-3xl font-extrabold tracking-tight text-balance sm:text-5xl">{{ $heading }}</h1>
            </div>
        </div>

        @isset($lead)
            <p class="mt-6 max-w-3xl text-lg leading-relaxed text-base-content/70">{{ $lead }}</p>
        @endisset
    </div>
</section>
