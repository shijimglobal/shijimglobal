@extends('layouts.admin')

@section('title', __('Dashboard'))
@section('subtitle', __('Hello, :name! Here is what is happening today.', ['name' => auth()->user()->name]))

@php
    $statCards = [
        ['label' => __('Total requests'), 'value' => $totalMessagesCount, 'icon' => 'ti-inbox', 'tone' => 'bg-primary/10 text-primary'],
        ['label' => __('Unread'), 'value' => $unreadMessagesCount, 'icon' => 'ti-mail-opened', 'tone' => 'bg-warning/15 text-warning'],
        ['label' => __('Today'), 'value' => $todayMessagesCount, 'icon' => 'ti-calendar-event', 'tone' => 'bg-secondary/10 text-secondary'],
        ['label' => __('Last 7 days'), 'value' => $weekMessagesCount, 'icon' => 'ti-trending-up', 'tone' => 'bg-success/15 text-success'],
    ];

    $highestServiceCount = max($messagesPerService->max() ?? 0, 1);
@endphp

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($statCards as $statCard)
            <div class="rounded-3xl border border-base-300/70 bg-base-100 p-5 sm:p-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-base-content/60">{{ $statCard['label'] }}</p>
                    <span class="flex size-11 items-center justify-center rounded-2xl {{ $statCard['tone'] }}">
                        <i class="ti {{ $statCard['icon'] }} text-2xl"></i>
                    </span>
                </div>
                <p class="mt-4 text-3xl font-extrabold tracking-tight">{{ number_format($statCard['value']) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 xl:grid-cols-3">
        {{-- Latest messages --}}
        <section class="rounded-3xl border border-base-300/70 bg-base-100 xl:col-span-2">
            <div class="flex items-center justify-between gap-4 border-b border-base-300/70 px-5 py-4 sm:px-6">
                <h2 class="text-lg font-bold">{{ __('Latest requests') }}</h2>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-text btn-sm gap-1 rounded-xl text-primary">
                    {{ __('View all') }}
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>

            @forelse ($latestMessages as $latestMessage)
                <a href="{{ route('admin.messages.show', $latestMessage) }}" class="flex items-center gap-4 border-b border-base-300/50 px-5 py-4 transition last:border-0 hover:bg-base-200/50 sm:px-6">
                    <span class="relative flex size-11 shrink-0 items-center justify-center rounded-2xl bg-base-200 font-bold text-base-content/70">
                        {{ mb_strtoupper(mb_substr($latestMessage->name, 0, 1)) }}
                        @unless ($latestMessage->isRead())
                            <span class="absolute -top-0.5 -right-0.5 size-3 rounded-full border-2 border-base-100 bg-primary"></span>
                        @endunless
                    </span>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <p @class(['truncate', 'font-bold' => ! $latestMessage->isRead(), 'font-semibold' => $latestMessage->isRead()])>{{ $latestMessage->name }}</p>
                            <span class="hidden shrink-0 rounded-full bg-primary/10 px-2 py-0.5 text-xs font-semibold text-primary sm:inline">{{ __($latestMessage->service) }}</span>
                        </div>
                        <p class="truncate text-sm text-base-content/60">{{ $latestMessage->message }}</p>
                    </div>
                    <span class="shrink-0 text-xs text-base-content/50">{{ $latestMessage->created_at->diffForHumans() }}</span>
                </a>
            @empty
                <div class="flex flex-col items-center px-6 py-14 text-center">
                    <span class="flex size-16 items-center justify-center rounded-3xl bg-base-200 text-base-content/40">
                        <i class="ti ti-inbox-off text-3xl"></i>
                    </span>
                    <p class="mt-4 font-semibold">{{ __('No requests yet') }}</p>
                    <p class="mt-1 text-sm text-base-content/55">{{ __('Requests sent from the website contact form will appear here.') }}</p>
                </div>
            @endforelse
        </section>

        {{-- Requests per service --}}
        <section class="rounded-3xl border border-base-300/70 bg-base-100">
            <div class="border-b border-base-300/70 px-5 py-4 sm:px-6">
                <h2 class="text-lg font-bold">{{ __('Requests by service') }}</h2>
            </div>
            <div class="space-y-5 px-5 py-5 sm:px-6">
                @forelse ($messagesPerService as $serviceName => $serviceCount)
                    <div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="font-semibold">{{ __($serviceName) }}</span>
                            <span class="font-bold text-base-content/70">{{ $serviceCount }}</span>
                        </div>
                        <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-base-200">
                            <div class="h-full rounded-full bg-brand-gradient" style="width: {{ round($serviceCount / $highestServiceCount * 100) }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="py-8 text-center text-sm text-base-content/55">{{ __('No data yet.') }}</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
