<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shijim">
<head>
    @include('partials.head', ['title' => __('Sign in').' — '.__(config('company.name'))])
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="min-h-screen bg-base-200 font-sans text-base-content antialiased transition-colors duration-300">
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- Brand panel --}}
        <aside class="relative hidden overflow-hidden bg-brand-gradient p-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="bg-grid pointer-events-none absolute inset-0 opacity-40 invert"></div>
            <img src="{{ asset('assets/logo/Asset 6.png') }}" alt="" aria-hidden="true" class="animate-spin-slow pointer-events-none absolute -right-32 -bottom-32 size-[30rem] opacity-10">

            <a href="{{ route('home') }}" class="relative">
                <img src="{{ asset('assets/logo/horiz_white.png') }}" alt="{{ __(config('company.name')) }}" class="h-12 w-auto">
            </a>

            <div class="relative max-w-md">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold tracking-wide uppercase">
                    <i class="ti ti-shield-lock text-sm"></i>
                    {{ __('Admin panel') }}
                </span>
                <h1 class="mt-5 text-4xl leading-tight font-extrabold">{{ __(config('company.slogan')) }}</h1>
                <p class="mt-4 text-lg leading-relaxed text-white/80">{{ __('Manage incoming requests and keep in touch with your customers from one place.') }}</p>

                <ul class="mt-10 space-y-4">
                    @foreach ([['ti-inbox', __('Track contact requests')], ['ti-chart-bar', __('See statistics at a glance')], ['ti-device-mobile', __('Works on every device')]] as [$featureIcon, $featureLabel])
                        <li class="flex items-center gap-3">
                            <span class="flex size-10 items-center justify-center rounded-xl bg-white/15"><i class="ti {{ $featureIcon }} text-xl"></i></span>
                            <span class="font-medium">{{ $featureLabel }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <p class="relative text-sm text-white/60">&copy; {{ now()->year }} {{ __(config('company.name')) }}</p>
        </aside>

        {{-- Form panel --}}
        <main class="relative flex flex-col px-4 py-6 sm:px-8">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="btn btn-text h-10 min-h-10 gap-2 rounded-xl px-3 text-sm font-semibold">
                    <i class="ti ti-arrow-left text-lg"></i>
                    {{ __('Back to website') }}
                </a>
                @include('partials.preference-controls', ['id' => 'login'])
            </div>

            <div class="flex flex-1 items-center justify-center py-10">
                <div class="w-full max-w-md">
                    <div class="mb-8 lg:hidden">
                        <x-logo :alt="__(config('company.name'))" class="h-12" />
                    </div>

                    <div class="rounded-3xl border border-base-300/70 bg-base-100 p-6 shadow-2xl shadow-primary/5 sm:p-10">
                        <span class="flex size-14 items-center justify-center rounded-2xl bg-brand-gradient text-white shadow-lg shadow-primary/30">
                            <i class="ti ti-lock text-3xl"></i>
                        </span>
                        <h2 class="mt-6 text-2xl font-extrabold tracking-tight sm:text-3xl">{{ __('Welcome back') }}</h2>
                        <p class="mt-2 text-base-content/65">{{ __('Sign in to the admin panel to continue.') }}</p>

                        <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                            @csrf

                            <div>
                                <label class="field-label" for="email">{{ __('Email') }}</label>
                                <div class="relative">
                                    <i class="ti ti-mail pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@shijimglobal.mn" class="input field-shell ps-12 @error('email') is-invalid @enderror" autocomplete="username" autofocus required>
                                </div>
                                @error('email')
                                    <p class="field-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="field-label" for="password">{{ __('Password') }}</label>
                                <div class="relative">
                                    <i class="ti ti-key pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                                    <input type="password" id="password" name="password" placeholder="••••••••" class="input field-shell ps-12 pe-12 @error('password') is-invalid @enderror" autocomplete="current-password" required>
                                    <button type="button" data-password-toggle="#password" class="absolute top-1/2 right-2 z-10 flex size-9 -translate-y-1/2 items-center justify-center rounded-lg text-base-content/50 transition hover:bg-base-200 hover:text-primary" aria-label="{{ __('Show password') }}">
                                        <i class="ti ti-eye text-xl"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="field-error"><i class="ti ti-alert-circle"></i> {{ $message }}</p>
                                @enderror
                            </div>

                            <label class="flex cursor-pointer items-center gap-3 text-sm font-medium text-base-content/75">
                                <input type="checkbox" name="remember" value="1" class="checkbox checkbox-primary checkbox-sm rounded-md" @checked(old('remember'))>
                                {{ __('Remember me') }}
                            </label>

                            <button type="submit" class="btn btn-block h-13 rounded-2xl border-0 bg-brand-gradient text-base text-white shadow-lg shadow-primary/30 hover:opacity-90">
                                {{ __('Sign in') }}
                                <i class="ti ti-login-2 text-xl"></i>
                            </button>
                        </form>
                    </div>

                    <p class="mt-6 flex items-center justify-center gap-2 text-center text-sm text-base-content/55">
                        <i class="ti ti-shield-check text-base"></i>
                        {{ __('Protected area. Authorized staff only.') }}
                    </p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
