<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="shijim">
<head>
    @include('partials.head', ['title' => trim($__env->yieldContent('title')).' — '.__('Admin panel')])
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="min-h-screen bg-base-200 font-sans text-base-content antialiased transition-colors duration-300">
    @php
        $adminNavigation = [
            ['label' => __('Dashboard'), 'icon' => 'icon-[tabler--layout-dashboard]', 'route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'badge' => null],
            ['label' => __('Messages'), 'icon' => 'icon-[tabler--inbox]', 'route' => 'admin.messages.index', 'pattern' => 'admin.messages.*', 'badge' => $unreadMessagesTotal ?: null],
        ];
    @endphp

    {{-- Mobile backdrop --}}
    <div data-sidebar-backdrop class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-sm lg:hidden"></div>

    {{-- Sidebar --}}
    <aside data-sidebar class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-e border-base-300/70 bg-base-100 transition-transform duration-300 lg:translate-x-0">
        <div class="flex h-20 items-center justify-between px-6">
            <a href="{{ route('admin.dashboard') }}">
                <x-logo :alt="__(config('company.name'))" class="h-11" />
            </a>
            <button type="button" data-sidebar-close class="btn btn-text btn-square size-9 min-h-9 rounded-xl lg:hidden" aria-label="{{ __('Close menu') }}">
                <i class="icon-[tabler--x] text-xl"></i>
            </button>
        </div>

        <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-4">
            <p class="px-3 pb-2 text-xs font-bold tracking-widest text-base-content/40 uppercase">{{ __('Menu') }}</p>
            @foreach ($adminNavigation as $navigationItem)
                @php $isCurrent = request()->routeIs($navigationItem['pattern']); @endphp
                <a href="{{ route($navigationItem['route']) }}" @class([
                    'flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold transition',
                    'bg-brand-gradient text-white shadow-lg shadow-primary/25' => $isCurrent,
                    'text-base-content/70 hover:bg-base-200 hover:text-primary' => ! $isCurrent,
                ]) @if ($isCurrent) aria-current="page" @endif>
                    <i class="{{ $navigationItem['icon'] }} text-xl"></i>
                    <span class="flex-1">{{ $navigationItem['label'] }}</span>
                    @if ($navigationItem['badge'])
                        <span @class([
                            'rounded-full px-2 py-0.5 text-xs font-bold',
                            'bg-white/25 text-white' => $isCurrent,
                            'bg-primary text-primary-content' => ! $isCurrent,
                        ])>{{ $navigationItem['badge'] }}</span>
                    @endif
                </a>
            @endforeach

            <p class="px-3 pt-6 pb-2 text-xs font-bold tracking-widest text-base-content/40 uppercase">{{ __('Website') }}</p>
            <a href="{{ route('home') }}" target="_blank" rel="noopener" class="flex items-center gap-3 rounded-xl px-3 py-2.5 font-semibold text-base-content/70 transition hover:bg-base-200 hover:text-primary">
                <i class="icon-[tabler--world] text-xl"></i>
                <span class="flex-1">{{ __('View website') }}</span>
                <i class="icon-[tabler--external-link] text-base opacity-50"></i>
            </a>
        </nav>

        <div class="border-t border-base-300/70 p-4">
            <div class="flex items-center gap-3 rounded-2xl bg-base-200/70 p-3">
                <span class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-brand-gradient font-bold text-white">
                    {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                </span>
                <a href="{{ route('admin.profile.edit') }}" class="min-w-0 flex-1 hover:text-primary">
                    <p class="truncate text-sm font-bold">{{ auth()->user()->name }}</p>
                    <p class="truncate text-xs text-base-content/55">{{ auth()->user()->email }}</p>
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-text btn-square size-9 min-h-9 rounded-xl text-base-content/60 hover:bg-error/10 hover:text-error" aria-label="{{ __('Sign out') }}" title="{{ __('Sign out') }}">
                        <i class="icon-[tabler--logout] text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Main --}}
    <div class="lg:ps-72">
        <header class="sticky top-0 z-30 border-b border-base-300/70 bg-base-100/85 backdrop-blur-md">
            <div class="flex h-20 items-center gap-3 px-4 sm:px-8">
                <button type="button" data-sidebar-open class="btn btn-text btn-square size-10 min-h-10 rounded-xl lg:hidden" aria-label="{{ __('Open menu') }}">
                    <i class="icon-[tabler--menu-2] text-2xl"></i>
                </button>
                <div class="min-w-0 flex-1">
                    <h1 class="truncate text-xl font-extrabold tracking-tight sm:text-2xl">@yield('title')</h1>
                    @hasSection('subtitle')
                        <p class="hidden truncate text-sm text-base-content/55 sm:block">@yield('subtitle')</p>
                    @endif
                </div>
                <div class="hidden sm:block">
                    @include('partials.preference-controls', ['id' => 'admin'])
                </div>

                {{-- Notifications --}}
                <div class="dropdown relative inline-flex [--offset:12] [--placement:bottom-end]">
                    <button id="notifications-dropdown" type="button" class="dropdown-toggle btn btn-text btn-square relative size-10 min-h-10 rounded-xl" aria-haspopup="menu" aria-expanded="false" aria-label="{{ __('Notifications') }}">
                        <i class="icon-[tabler--bell] text-xl"></i>
                        <span data-notification-badge @class([
                            'absolute -top-0.5 -right-0.5 min-w-5 rounded-full border-2 border-base-100 bg-error px-1 text-[0.65rem] leading-4 font-bold text-white',
                            'hidden' => ! $unreadNotificationsTotal,
                        ])>{{ $unreadNotificationsTotal > 99 ? '99+' : $unreadNotificationsTotal }}</span>
                    </button>
                    <div class="dropdown-menu hidden w-[calc(100vw-2rem)] max-w-sm rounded-3xl border border-base-300 p-0 shadow-2xl dropdown-open:opacity-100" role="menu" aria-orientation="vertical" aria-labelledby="notifications-dropdown">
                        <div class="flex items-center justify-between border-b border-base-300/70 px-5 py-4">
                            <p class="font-bold">{{ __('Notifications') }}</p>
                            @if ($unreadNotificationsTotal)
                                <form method="POST" action="{{ route('admin.notifications.read-all') }}">
                                    @csrf
                                    <button type="submit" class="text-sm font-semibold text-primary hover:underline">{{ __('Mark all as read') }}</button>
                                </form>
                            @endif
                        </div>
                        <div class="max-h-96 overflow-y-auto p-2">
                            @forelse ($recentNotifications as $notification)
                                <a href="{{ route('admin.notifications.open', $notification->id) }}" @class([
                                    'flex gap-3 rounded-2xl p-3 transition hover:bg-base-200',
                                    'bg-primary/5' => $notification->unread(),
                                ])>
                                    <span class="relative flex size-10 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                        <i class="icon-[tabler--message-plus] text-xl"></i>
                                        @if ($notification->unread())
                                            <span class="absolute -top-0.5 -right-0.5 size-2.5 rounded-full bg-primary"></span>
                                        @endif
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <span @class(['block truncate text-sm', 'font-bold' => $notification->unread(), 'font-semibold' => $notification->read()])>
                                            {{ __('New request from :name', ['name' => $notification->data['name']]) }}
                                        </span>
                                        <span class="block truncate text-xs text-base-content/60">{{ __($notification->data['service']) }} · {{ $notification->data['excerpt'] }}</span>
                                        <span class="mt-1 block text-xs text-base-content/45">{{ $notification->created_at->diffForHumans() }}</span>
                                    </span>
                                </a>
                            @empty
                                <div class="flex flex-col items-center px-4 py-10 text-center">
                                    <span class="flex size-14 items-center justify-center rounded-2xl bg-base-200 text-base-content/40"><i class="icon-[tabler--bell-off] text-2xl"></i></span>
                                    <p class="mt-3 text-sm font-semibold">{{ __('No notifications yet') }}</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Profile --}}
                <div class="dropdown relative inline-flex [--offset:12] [--placement:bottom-end]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle flex items-center gap-2 rounded-xl p-1 transition hover:bg-base-200 sm:pe-2" aria-haspopup="menu" aria-expanded="false" aria-label="{{ __('Profile') }}">
                        <span class="flex size-9 items-center justify-center rounded-xl bg-brand-gradient text-sm font-bold text-white">
                            {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="hidden max-w-32 truncate text-sm font-semibold md:block">{{ auth()->user()->name }}</span>
                        <i class="icon-[tabler--chevron-down] hidden text-sm text-base-content/50 transition-transform md:block dropdown-open:rotate-180"></i>
                    </button>
                    <div class="dropdown-menu hidden w-64 rounded-3xl border border-base-300 p-2 shadow-2xl dropdown-open:opacity-100" role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <div class="flex items-center gap-3 px-3 py-3">
                            <span class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-brand-gradient font-bold text-white">
                                {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="min-w-0">
                                <span class="block truncate font-bold">{{ auth()->user()->name }}</span>
                                <span class="block truncate text-xs text-base-content/55">{{ auth()->user()->email }}</span>
                            </span>
                        </div>
                        <div class="my-1 border-t border-base-300/70"></div>
                        <a href="{{ route('admin.profile.edit') }}" class="dropdown-item gap-3 rounded-xl">
                            <i class="icon-[tabler--user-cog] text-lg"></i>
                            {{ __('Profile settings') }}
                        </a>
                        <a href="{{ route('admin.profile.edit') }}#password" class="dropdown-item gap-3 rounded-xl">
                            <i class="icon-[tabler--key] text-lg"></i>
                            {{ __('Change password') }}
                        </a>
                        <button type="button" data-theme-toggle class="dropdown-item gap-3 rounded-xl sm:hidden">
                            <i class="icon-[tabler--moon] text-lg dark:hidden"></i>
                            <i class="icon-[tabler--sun] hidden text-lg dark:inline-block"></i>
                            {{ __('Toggle dark mode') }}
                        </button>
                        @foreach (config('company.locales') as $localeCode => $localeName)
                            @continue($localeCode === app()->getLocale())
                            <a href="{{ route('locale.switch', $localeCode) }}" class="dropdown-item gap-3 rounded-xl sm:hidden">
                                <i class="icon-[tabler--world] text-lg"></i>
                                {{ $localeName }}
                            </a>
                        @endforeach
                        <div class="my-1 border-t border-base-300/70"></div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item gap-3 rounded-xl text-error hover:bg-error/10">
                                <i class="icon-[tabler--logout] text-lg"></i>
                                {{ __('Sign out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- Live notification toast --}}
        <div data-notification-poll="{{ route('admin.notifications.poll') }}" data-notification-count="{{ $unreadNotificationsTotal }}" class="hidden"></div>
        <div data-notification-toast class="pointer-events-none fixed end-4 top-24 z-50 w-[calc(100vw-2rem)] max-w-sm translate-x-4 opacity-0 transition duration-300 sm:end-8">
            <a href="#" data-notification-toast-link class="pointer-events-auto flex gap-3 rounded-3xl border border-base-300 bg-base-100 p-4 shadow-2xl shadow-primary/15">
                <span class="flex size-11 shrink-0 items-center justify-center rounded-2xl bg-brand-gradient text-white">
                    <i class="icon-[tabler--bell-ringing] text-xl"></i>
                </span>
                <span class="min-w-0 flex-1">
                    <span data-notification-toast-title class="block truncate font-bold"></span>
                    <span data-notification-toast-body class="mt-0.5 line-clamp-2 block text-sm text-base-content/65"></span>
                </span>
                <button type="button" data-notification-toast-close class="flex size-8 shrink-0 items-center justify-center rounded-lg text-base-content/50 hover:bg-base-200" aria-label="{{ __('Close') }}">
                    <i class="icon-[tabler--x]"></i>
                </button>
            </a>
        </div>

        <main class="px-4 py-6 sm:px-8 sm:py-8">
            @if (session('status'))
                <div class="alert alert-soft alert-success mb-6 flex items-center gap-3 rounded-2xl" role="alert">
                    <i class="icon-[tabler--circle-check] text-2xl"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
