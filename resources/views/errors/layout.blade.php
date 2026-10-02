<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shijim">
<head>
    @include('partials.head', ['title' => $code.' — '.$heading])
    <meta name="robots" content="noindex">
</head>
<body class="min-h-screen bg-base-200 font-sans text-base-content antialiased">
    <div class="relative flex min-h-screen flex-col overflow-hidden">
        <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_center,black_20%,transparent_70%)]"></div>
        <div class="pointer-events-none absolute -top-40 -right-40 size-[32rem] glow-brand-indigo/35"></div>
        <div class="pointer-events-none absolute -bottom-40 -left-40 size-[28rem] glow-brand-blue/35"></div>

        <header class="relative flex items-center justify-between px-4 py-5 sm:px-8">
            <a href="{{ url('/') }}">
                <x-logo :alt="__(config('company.name'))" class="h-11" />
            </a>
            <button type="button" data-theme-toggle class="btn btn-text btn-square size-10 min-h-10 rounded-xl" aria-label="{{ __('Toggle dark mode') }}">
                <i class="icon-[tabler--moon] text-xl dark:hidden"></i>
                <i class="icon-[tabler--sun] hidden text-xl dark:inline-block"></i>
            </button>
        </header>

        <main class="relative flex flex-1 items-center justify-center px-4 pb-16">
            <div class="w-full max-w-xl text-center">
                <div class="relative mx-auto flex size-28 items-center justify-center">
                    <div class="animate-spin-slow absolute inset-0 rounded-full border-2 border-dashed border-brand-indigo/30"></div>
                    <span class="flex size-20 items-center justify-center rounded-3xl bg-brand-gradient text-white shadow-2xl shadow-primary/30">
                        <i class="{{ $icon }} text-4xl"></i>
                    </span>
                </div>

                <p class="text-gradient mt-8 text-7xl font-extrabold tracking-tight sm:text-8xl">{{ $code }}</p>
                <h1 class="mt-4 text-2xl font-extrabold tracking-tight text-balance sm:text-3xl">{{ $heading }}</h1>
                <p class="mx-auto mt-3 max-w-md leading-relaxed text-base-content/65">{{ $description }}</p>

                <div class="mt-10 flex flex-col justify-center gap-3 sm:flex-row">
                    <a href="{{ url('/') }}" class="btn btn-cta border-0 bg-brand-gradient text-white shadow-lg shadow-primary/30 hover:opacity-90">
                        <i class="icon-[tabler--home] text-lg"></i>
                        {{ __('Back to home') }}
                    </a>
                    <button type="button" onclick="history.length > 1 ? history.back() : location.assign('{{ url('/') }}')" class="btn btn-cta btn-outline border-base-300 bg-base-100 hover:border-primary hover:bg-primary/5 hover:text-primary">
                        <i class="icon-[tabler--arrow-left] text-lg"></i>
                        {{ __('Go back') }}
                    </button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
