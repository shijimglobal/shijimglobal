@extends('layouts.admin')

@section('title', __('Messages'))
@section('subtitle', __('Requests sent from the website contact form.'))

@php
    $statusTabs = [
        null => __('All'),
        'unread' => __('Unread'),
        'read' => __('Read'),
    ];

    $currentStatus = $filters['status'] ?? null;
    $currentService = $filters['service'] ?? null;
@endphp

@section('content')
    <div class="rounded-3xl border border-base-300/70 bg-base-100">
        {{-- Filters --}}
        <div class="space-y-4 border-b border-base-300/70 p-4 sm:p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="inline-flex w-full rounded-2xl bg-base-200/70 p-1.5 sm:w-auto">
                    @foreach ($statusTabs as $statusValue => $statusLabel)
                        <a href="{{ route('admin.messages.index', array_filter(['status' => $statusValue, 'service' => $currentService, 'search' => $filters['search'] ?? null])) }}" @class([
                            'flex-1 rounded-xl px-4 py-2 text-center text-sm font-semibold transition sm:flex-none',
                            'bg-base-100 text-primary shadow-sm' => $currentStatus === ($statusValue ?: null),
                            'text-base-content/65 hover:text-primary' => $currentStatus !== ($statusValue ?: null),
                        ])>{{ $statusLabel }}</a>
                    @endforeach
                </div>

                <form method="GET" action="{{ route('admin.messages.index') }}" class="relative w-full lg:max-w-sm">
                    @if ($currentStatus)
                        <input type="hidden" name="status" value="{{ $currentStatus }}">
                    @endif
                    @if ($currentService)
                        <input type="hidden" name="service" value="{{ $currentService }}">
                    @endif
                    <i class="icon-[tabler--search] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                    <input type="search" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="{{ __('Search by name, phone, email…') }}" class="input field-shell h-11 ps-12" aria-label="{{ __('Search') }}">
                </form>
            </div>

            <div class="-mx-1 flex gap-2 overflow-x-auto px-1 pb-1">
                <a href="{{ route('admin.messages.index', array_filter(['status' => $currentStatus, 'search' => $filters['search'] ?? null])) }}" @class([
                    'shrink-0 rounded-full border px-3.5 py-1.5 text-sm font-semibold transition',
                    'border-primary bg-primary text-primary-content' => ! $currentService,
                    'border-base-300 text-base-content/70 hover:border-primary hover:text-primary' => $currentService,
                ])>{{ __('All services') }}</a>
                @foreach (\App\Http\Requests\StoreContactRequest::SERVICES as $serviceOption)
                    <a href="{{ route('admin.messages.index', array_filter(['status' => $currentStatus, 'service' => $serviceOption, 'search' => $filters['search'] ?? null])) }}" @class([
                        'shrink-0 rounded-full border px-3.5 py-1.5 text-sm font-semibold transition',
                        'border-primary bg-primary text-primary-content' => $currentService === $serviceOption,
                        'border-base-300 text-base-content/70 hover:border-primary hover:text-primary' => $currentService !== $serviceOption,
                    ])>{{ __($serviceOption) }}</a>
                @endforeach
            </div>
        </div>

        {{-- List --}}
        @forelse ($messages as $contactMessage)
            <a href="{{ route('admin.messages.show', $contactMessage) }}" @class([
                'group flex gap-4 border-b border-base-300/50 px-4 py-4 transition last:border-0 hover:bg-base-200/50 sm:items-center sm:px-6',
                'bg-primary/[0.03]' => ! $contactMessage->isRead(),
            ])>
                <span class="relative flex size-11 shrink-0 items-center justify-center rounded-2xl bg-base-200 font-bold text-base-content/70">
                    {{ mb_strtoupper(mb_substr($contactMessage->name, 0, 1)) }}
                    @unless ($contactMessage->isRead())
                        <span class="absolute -top-0.5 -right-0.5 size-3 rounded-full border-2 border-base-100 bg-primary"></span>
                    @endunless
                </span>

                <div class="min-w-0 flex-1 sm:grid sm:grid-cols-12 sm:items-center sm:gap-4">
                    <div class="min-w-0 sm:col-span-3">
                        <p @class(['truncate', 'font-bold' => ! $contactMessage->isRead(), 'font-semibold' => $contactMessage->isRead()])>{{ $contactMessage->name }}</p>
                        <p class="truncate text-sm text-base-content/55">{{ $contactMessage->phone }}</p>
                    </div>
                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                        <span class="inline-block rounded-full bg-primary/10 px-2.5 py-0.5 text-xs font-semibold text-primary">{{ __($contactMessage->service) }}</span>
                    </div>
                    <p class="mt-1 line-clamp-2 text-sm text-base-content/65 sm:col-span-5 sm:mt-0 sm:line-clamp-1">{{ $contactMessage->message }}</p>
                    <p class="mt-1 text-xs text-base-content/50 sm:col-span-2 sm:mt-0 sm:text-end">{{ $contactMessage->created_at->diffForHumans() }}</p>
                </div>

                <i class="icon-[tabler--chevron-right] hidden text-xl text-base-content/30 transition group-hover:translate-x-0.5 group-hover:text-primary sm:block"></i>
            </a>
        @empty
            <div class="flex flex-col items-center px-6 py-16 text-center">
                <span class="flex size-16 items-center justify-center rounded-3xl bg-base-200 text-base-content/40">
                    <i class="icon-[tabler--inbox-off] text-3xl"></i>
                </span>
                <p class="mt-4 font-semibold">{{ __('No requests found') }}</p>
                <p class="mt-1 text-sm text-base-content/55">{{ __('Try changing the filters or search term.') }}</p>
            </div>
        @endforelse

        @if ($messages->hasPages())
            <div class="border-t border-base-300/70 px-4 py-4 sm:px-6">
                {{ $messages->links('partials.pagination') }}
            </div>
        @endif
    </div>
@endsection
