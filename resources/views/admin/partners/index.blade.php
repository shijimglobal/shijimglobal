@extends('layouts.admin')

@section('title', __('Partners'))
@section('subtitle', __('Logos shown in the scrolling partners section on the website.'))

@php
    // Re-open the modal with the submitted values when validation failed.
    $editingPartnerId = old('editing_partner_id');
    $editingPartner = $editingPartnerId ? $partners->firstWhere('id', (int) $editingPartnerId) : null;
    $shouldReopenModal = $errors->any();
@endphp

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <p class="text-sm text-base-content/60">{{ trans_choice(':count partner|:count partners', $partners->count(), ['count' => $partners->count()]) }}</p>
        <button type="button" data-partner-modal-open class="btn h-11 rounded-xl border-0 bg-brand-gradient px-5 text-white shadow-lg shadow-primary/25 hover:opacity-90">
            <i class="icon-[tabler--plus] text-lg"></i>
            {{ __('Add partner') }}
        </button>
    </div>

    @if ($partners->isEmpty())
        <div class="flex flex-col items-center rounded-3xl border border-dashed border-base-300 bg-base-100 px-6 py-16 text-center">
            <span class="flex size-16 items-center justify-center rounded-3xl bg-base-200 text-base-content/40">
                <i class="icon-[tabler--building-community] text-3xl"></i>
            </span>
            <p class="mt-4 font-semibold">{{ __('No partners yet') }}</p>
            <p class="mt-1 max-w-sm text-sm text-base-content/55">{{ __('Add a partner and its logo will start scrolling on the website.') }}</p>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-base-300/70 bg-base-100">
            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-base-300/70 bg-base-200/40 px-4 py-3 text-sm text-base-content/70 sm:px-5">
                <span class="flex items-center gap-2">
                    <i class="icon-[tabler--arrows-sort] text-lg text-primary"></i>
                    {{ __('Drag the rows to change the order on the website.') }}
                </span>
                <span data-partner-order-status class="flex items-center gap-1.5 font-semibold opacity-0 transition-opacity duration-300"
                    data-saving-text="{{ __('Saving…') }}" data-saved-text="{{ __('Order saved') }}" data-failed-text="{{ __('Could not save the order. Refresh the page and try again.') }}"></span>
            </div>

            <ul class="divide-y divide-base-300/60" data-partner-sortable data-reorder-url="{{ route('admin.partners.reorder') }}">
                @foreach ($partners as $partner)
                    <li data-partner-id="{{ $partner->id }}" class="flex items-center gap-3 bg-base-100 px-3 py-3 transition-colors sm:gap-4 sm:px-5">
                        <button type="button" data-partner-drag-handle class="flex size-9 shrink-0 cursor-grab touch-none items-center justify-center rounded-xl text-base-content/40 transition hover:bg-base-200 hover:text-base-content active:cursor-grabbing" aria-label="{{ __('Drag to reorder') }}" title="{{ __('Drag to reorder') }}">
                            <i class="icon-[tabler--grip-vertical] text-xl"></i>
                        </button>

                        <span data-partner-position class="hidden w-6 shrink-0 text-center text-sm font-bold text-base-content/40 sm:block">{{ $loop->iteration }}</span>

                        <div @class(['flex h-14 w-24 shrink-0 items-center justify-center rounded-xl border border-base-300/60 bg-white p-2 sm:w-28', 'opacity-50' => ! $partner->is_active])>
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain" draggable="false">
                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="truncate font-bold">{{ $partner->name }}</p>
                            @if ($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener" class="block truncate text-sm text-primary hover:underline">{{ preg_replace('#^https?://(www\.)?#', '', $partner->website_url) }}</a>
                            @else
                                <p class="text-sm text-base-content/40">—</p>
                            @endif
                        </div>

                        <span @class([
                            'hidden shrink-0 rounded-full px-2.5 py-0.5 text-xs font-semibold sm:inline-block',
                            'bg-success/15 text-success' => $partner->is_active,
                            'bg-base-200 text-base-content/60' => ! $partner->is_active,
                        ])>{{ $partner->is_active ? __('Visible') : __('Hidden') }}</span>

                        <div class="flex shrink-0 items-center gap-1">
                            <button type="button" class="flex size-9 items-center justify-center rounded-xl text-base-content/60 transition hover:bg-base-200 hover:text-primary"
                                aria-label="{{ __('Edit') }}" title="{{ __('Edit') }}"
                                data-partner-modal-open
                                data-partner="{{ json_encode([
                                    'id' => $partner->id,
                                    'name' => $partner->name,
                                    'website_url' => $partner->website_url,
                                    'is_active' => $partner->is_active,
                                    'logo_url' => $partner->logo_url,
                                    'update_url' => route('admin.partners.update', $partner),
                                ]) }}">
                                <i class="icon-[tabler--pencil] text-lg"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" data-confirm="{{ __('Delete this partner?') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex size-9 items-center justify-center rounded-xl text-base-content/60 transition hover:bg-error/10 hover:text-error" aria-label="{{ __('Delete') }}" title="{{ __('Delete') }}">
                                    <i class="icon-[tabler--trash] text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add / edit partner modal --}}
    <dialog data-partner-modal @if ($shouldReopenModal) data-open-on-load @endif
        data-title-create="{{ __('Add partner') }}" data-title-edit="{{ __('Edit partner') }}"
        data-submit-create="{{ __('Add partner') }}" data-submit-edit="{{ __('Save changes') }}"
        data-store-url="{{ route('admin.partners.store') }}"
        class="m-auto w-[calc(100%-2rem)] max-w-2xl rounded-3xl bg-base-100 p-0 text-base-content shadow-2xl backdrop:bg-black/50 backdrop:backdrop-blur-sm"
        aria-labelledby="partner-modal-title">
        <form method="POST"
            action="{{ $editingPartner ? route('admin.partners.update', $editingPartner) : route('admin.partners.store') }}"
            enctype="multipart/form-data" data-partner-form>
            @csrf
            <input type="hidden" name="_method" value="PUT" data-partner-method @disabled(! $editingPartner)>
            <input type="hidden" name="editing_partner_id" value="{{ $editingPartner?->id }}" data-partner-field="id">

            <div class="flex items-center justify-between gap-4 border-b border-base-300/70 px-5 py-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="icon-[tabler--building-community] text-xl"></i>
                    </span>
                    <h2 id="partner-modal-title" class="text-lg font-bold" data-partner-modal-title>{{ $editingPartner ? __('Edit partner') : __('Add partner') }}</h2>
                </div>
                <button type="button" data-partner-modal-close class="flex size-9 items-center justify-center rounded-xl text-base-content/60 transition hover:bg-base-200" aria-label="{{ __('Close') }}">
                    <i class="icon-[tabler--x] text-xl"></i>
                </button>
            </div>

            <div class="grid max-h-[70vh] gap-5 overflow-y-auto p-5 sm:grid-cols-[13rem_1fr] sm:p-6">
                {{-- Logo --}}
                <div>
                    <span class="field-label">{{ __('Logo') }}</span>
                    <label for="logo" class="flex h-40 cursor-pointer flex-col items-center justify-center gap-2 rounded-2xl border-2 border-dashed border-base-300 bg-white p-4 text-center transition hover:border-primary @error('logo') border-error @enderror">
                        <img data-logo-preview src="{{ $editingPartner?->logo_url }}" alt="" @class(['max-h-full max-w-full object-contain', 'hidden' => ! $editingPartner])>
                        <span data-logo-placeholder @class(['flex flex-col items-center gap-2 text-base-content/50', 'hidden' => $editingPartner])>
                            <i class="icon-[tabler--photo-up] text-3xl"></i>
                            <span class="text-sm font-semibold">{{ __('Choose a logo') }}</span>
                        </span>
                    </label>
                    <input type="file" id="logo" name="logo" accept="image/png,image/jpeg,image/webp" class="sr-only" data-logo-input>
                    <p class="mt-2 text-center text-xs text-base-content/50">PNG, JPG, WebP · 2MB</p>
                    @error('logo')
                        <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                    @enderror
                </div>

                {{-- Details --}}
                <div class="space-y-4">
                    <div>
                        <label class="field-label" for="partner-name">{{ __('Organization name') }}</label>
                        <div class="relative">
                            <i class="icon-[tabler--building] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                            <input type="text" id="partner-name" name="name" value="{{ old('name') }}" data-partner-field="name" class="input field-shell ps-12 @error('name') is-invalid @enderror" required>
                        </div>
                        @error('name')
                            <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="partner-website">{{ __('Website') }} <span class="font-normal text-base-content/45">({{ __('optional') }})</span></label>
                        <div class="relative">
                            <i class="icon-[tabler--link] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                            <input type="url" id="partner-website" name="website_url" value="{{ old('website_url') }}" data-partner-field="website_url" placeholder="https://example.mn" class="input field-shell ps-12 @error('website_url') is-invalid @enderror">
                        </div>
                        @error('website_url')
                            <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <span class="field-label">{{ __('Visibility') }}</span>
                        <label class="flex h-13 cursor-pointer items-center justify-between gap-3 rounded-2xl border border-base-300 bg-base-200/60 ps-4 pe-3">
                            <span class="text-sm font-semibold">{{ __('Show on website') }}</span>
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" data-partner-field="is_active" class="switch switch-primary" @checked(old('is_active', '1'))>
                        </label>
                        <p class="mt-1.5 text-xs text-base-content/50">{{ __('New partners are added to the end of the list; drag them in the list to change the order.') }}</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse gap-2 border-t border-base-300/70 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">
                <button type="button" data-partner-modal-close class="btn btn-outline h-11 rounded-xl border-base-300 px-5 hover:bg-base-200">{{ __('Cancel') }}</button>
                <button type="submit" class="btn h-11 rounded-xl border-0 bg-brand-gradient px-6 text-white shadow-lg shadow-primary/25 hover:opacity-90">
                    <i class="icon-[tabler--device-floppy] text-lg"></i>
                    <span data-partner-submit-label>{{ $editingPartner ? __('Save changes') : __('Add partner') }}</span>
                </button>
            </div>
        </form>
    </dialog>
@endsection
