@extends('layouts.admin')

@section('title', __('Profile settings'))
@section('subtitle', __('Update your name, email address and password.'))

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-3">
        {{-- Summary --}}
        <aside class="rounded-3xl border border-base-300/70 bg-base-100 p-6 text-center lg:self-start">
            <span class="mx-auto flex size-20 items-center justify-center rounded-3xl bg-brand-gradient text-3xl font-extrabold text-white shadow-lg shadow-primary/25">
                {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
            </span>
            <p class="mt-4 truncate text-lg font-bold">{{ $user->name }}</p>
            <p class="truncate text-sm text-base-content/55">{{ $user->email }}</p>
            <span class="mt-4 inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">
                <i class="icon-[tabler--shield-check]"></i>
                {{ __('Administrator') }}
            </span>
            <p class="mt-6 text-xs text-base-content/50">{{ __('Member since :date', ['date' => $user->created_at->format('Y-m-d')]) }}</p>
        </aside>

        <div class="space-y-6 lg:col-span-2">
            {{-- Profile information --}}
            <section class="rounded-3xl border border-base-300/70 bg-base-100">
                <div class="flex items-center gap-3 border-b border-base-300/70 px-5 py-4 sm:px-6">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-primary/10 text-primary"><i class="icon-[tabler--user-edit] text-xl"></i></span>
                    <div>
                        <h2 class="font-bold">{{ __('Profile information') }}</h2>
                        <p class="text-sm text-base-content/55">{{ __('Your name and the email address you sign in with.') }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-5 p-5 sm:p-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="field-label" for="name">{{ __('Name') }}</label>
                        <div class="relative">
                            <i class="icon-[tabler--user] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="input field-shell ps-12 @error('name') is-invalid @enderror" autocomplete="name" required>
                        </div>
                        @error('name')
                            <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="email">{{ __('Email') }}</label>
                        <div class="relative">
                            <i class="icon-[tabler--mail] pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input field-shell ps-12 @error('email') is-invalid @enderror" autocomplete="username" required>
                        </div>
                        @error('email')
                            <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn h-11 rounded-xl border-0 bg-brand-gradient px-6 text-white shadow-lg shadow-primary/25 hover:opacity-90">
                            <i class="icon-[tabler--device-floppy] text-lg"></i>
                            {{ __('Save changes') }}
                        </button>
                    </div>
                </form>
            </section>

            {{-- Password --}}
            <section id="password" class="scroll-mt-28 rounded-3xl border border-base-300/70 bg-base-100">
                <div class="flex items-center gap-3 border-b border-base-300/70 px-5 py-4 sm:px-6">
                    <span class="flex size-10 items-center justify-center rounded-xl bg-warning/15 text-warning"><i class="icon-[tabler--key] text-xl"></i></span>
                    <div>
                        <h2 class="font-bold">{{ __('Change password') }}</h2>
                        <p class="text-sm text-base-content/55">{{ __('Use at least 8 characters with letters and numbers.') }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-5 p-5 sm:p-6">
                    @csrf
                    @method('PUT')

                    @foreach ([
                        ['id' => 'current_password', 'label' => __('Current password'), 'autocomplete' => 'current-password', 'icon' => 'icon-[tabler--lock]'],
                        ['id' => 'password', 'label' => __('New password'), 'autocomplete' => 'new-password', 'icon' => 'icon-[tabler--key]'],
                        ['id' => 'password_confirmation', 'label' => __('Confirm new password'), 'autocomplete' => 'new-password', 'icon' => 'icon-[tabler--key]'],
                    ] as $passwordField)
                        <div>
                            <label class="field-label" for="{{ $passwordField['id'] }}">{{ $passwordField['label'] }}</label>
                            <div class="relative">
                                <i class="{{ $passwordField['icon'] }} pointer-events-none absolute top-1/2 left-4 z-10 -translate-y-1/2 text-xl text-base-content/40"></i>
                                <input type="password" id="{{ $passwordField['id'] }}" name="{{ $passwordField['id'] }}" class="input field-shell ps-12 pe-12 @if ($errors->updatePassword->has($passwordField['id'])) is-invalid @endif" autocomplete="{{ $passwordField['autocomplete'] }}" required>
                                <button type="button" data-password-toggle="#{{ $passwordField['id'] }}" class="absolute top-1/2 right-2 z-10 flex size-9 -translate-y-1/2 items-center justify-center rounded-lg text-base-content/50 transition hover:bg-base-200 hover:text-primary" aria-label="{{ __('Show password') }}">
                                    <i class="icon-[tabler--eye] text-xl"></i>
                                </button>
                            </div>
                            @if ($errors->updatePassword->has($passwordField['id']))
                                <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $errors->updatePassword->first($passwordField['id']) }}</p>
                            @endif
                        </div>
                    @endforeach

                    <div class="flex justify-end">
                        <button type="submit" class="btn h-11 rounded-xl border-0 bg-brand-gradient px-6 text-white shadow-lg shadow-primary/25 hover:opacity-90">
                            <i class="icon-[tabler--lock-check] text-lg"></i>
                            {{ __('Update password') }}
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
