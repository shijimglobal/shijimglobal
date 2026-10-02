@extends('layouts.admin')

@section('title', $message->name)
@section('subtitle', __('Received :date', ['date' => $message->created_at->translatedFormat('Y-m-d H:i')]))

@section('content')
    <a href="{{ route('admin.messages.index') }}" class="btn btn-text btn-sm mb-4 gap-1 rounded-xl px-2">
        <i class="ti ti-arrow-left text-lg"></i>
        {{ __('Back to messages') }}
    </a>

    <div class="grid gap-6 xl:grid-cols-3">
        <article class="rounded-3xl border border-base-300/70 bg-base-100 xl:col-span-2">
            <div class="flex flex-wrap items-center gap-3 border-b border-base-300/70 px-5 py-4 sm:px-6">
                <span class="rounded-full bg-primary/10 px-3 py-1 text-sm font-semibold text-primary">{{ __($message->service) }}</span>
                <span class="text-sm text-base-content/55">{{ $message->created_at->diffForHumans() }}</span>
            </div>
            <div class="px-5 py-6 sm:px-6">
                <h2 class="text-sm font-bold tracking-wider text-base-content/50 uppercase">{{ __('Message') }}</h2>
                <p class="mt-3 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
            </div>
        </article>

        <aside class="space-y-6">
            <section class="rounded-3xl border border-base-300/70 bg-base-100 p-5 sm:p-6">
                <h2 class="text-lg font-bold">{{ __('Contact details') }}</h2>
                <ul class="mt-5 space-y-4">
                    <li class="flex items-center gap-3">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-base-200 text-base-content/60"><i class="ti ti-user text-xl"></i></span>
                        <div class="min-w-0">
                            <p class="text-xs text-base-content/55">{{ __('Name') }}</p>
                            <p class="truncate font-semibold">{{ $message->name }}</p>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-base-200 text-base-content/60"><i class="ti ti-phone text-xl"></i></span>
                        <div class="min-w-0">
                            <p class="text-xs text-base-content/55">{{ __('Phone') }}</p>
                            <a href="tel:{{ preg_replace('/\s+/', '', $message->phone) }}" class="truncate font-semibold hover:text-primary">{{ $message->phone }}</a>
                        </div>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex size-10 items-center justify-center rounded-xl bg-base-200 text-base-content/60"><i class="ti ti-mail text-xl"></i></span>
                        <div class="min-w-0">
                            <p class="text-xs text-base-content/55">{{ __('Email') }}</p>
                            @if ($message->email)
                                <a href="mailto:{{ $message->email }}" class="block truncate font-semibold hover:text-primary">{{ $message->email }}</a>
                            @else
                                <p class="text-base-content/45">—</p>
                            @endif
                        </div>
                    </li>
                </ul>

                <div class="mt-6 grid gap-2 sm:grid-cols-2 xl:grid-cols-1">
                    <a href="tel:{{ preg_replace('/\s+/', '', $message->phone) }}" class="btn h-11 rounded-xl border-0 bg-brand-gradient text-white hover:opacity-90">
                        <i class="ti ti-phone-call text-lg"></i>
                        {{ __('Call') }}
                    </a>
                    @if ($message->email)
                        <a href="mailto:{{ $message->email }}" class="btn btn-outline h-11 rounded-xl border-base-300 hover:border-primary hover:bg-primary/5 hover:text-primary">
                            <i class="ti ti-mail-forward text-lg"></i>
                            {{ __('Reply by email') }}
                        </a>
                    @endif
                </div>
            </section>

            <section class="rounded-3xl border border-base-300/70 bg-base-100 p-5 sm:p-6">
                <h2 class="text-lg font-bold">{{ __('Actions') }}</h2>
                <div class="mt-4 space-y-2">
                    <form method="POST" action="{{ route('admin.messages.unread', $message) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-text h-11 w-full justify-start gap-3 rounded-xl px-3 font-semibold hover:bg-base-200">
                            <i class="ti ti-mail text-xl text-primary"></i>
                            {{ __('Mark as unread') }}
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm="{{ __('Delete this message permanently?') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-text h-11 w-full justify-start gap-3 rounded-xl px-3 font-semibold text-error hover:bg-error/10">
                            <i class="ti ti-trash text-xl"></i>
                            {{ __('Delete') }}
                        </button>
                    </form>
                </div>
            </section>
        </aside>
    </div>
@endsection
