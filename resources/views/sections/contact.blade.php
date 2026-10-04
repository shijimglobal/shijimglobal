{{-- Contact --}}
<section id="contact" class="relative overflow-hidden border-t border-base-300/60 bg-base-200 py-12 sm:py-16">
    <div class="bg-grid pointer-events-none absolute inset-0 [mask-image:radial-gradient(ellipse_at_top,black_15%,transparent_65%)]"></div>
    <div class="relative mx-auto max-w-5xl px-3 sm:px-4 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl bg-brand-gradient p-5 shadow-xl shadow-primary/20 sm:p-8">
            <div class="relative grid items-center gap-8 lg:grid-cols-[1fr_1.2fr] lg:gap-10">
                <div class="px-2 text-white sm:px-0" data-reveal>
                    <h2 class="text-2xl leading-snug font-extrabold tracking-tight text-balance sm:text-3xl">{{ __('Are you ready to take your business to the next level?') }}</h2>
                    <p class="mt-3 text-sm leading-relaxed text-white/80 sm:text-base">
                        {{ __('Send us your request. Our team will contact you shortly with a free consultation.') }}
                    </p>

                    <ul class="mt-6 space-y-2.5">
                        <li>
                            <a href="mailto:{{ config('company.email') }}" class="group inline-flex items-center gap-3 text-sm font-semibold">
                                <span class="flex size-9 items-center justify-center rounded-xl bg-white/15 transition group-hover:bg-white group-hover:text-primary"><i class="icon-[tabler--mail] text-lg"></i></span>
                                <span>
                                    <span class="sr-only">{{ __('Email') }}: </span>
                                    <span>{{ config('company.email') }}</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="tel:{{ str_replace(' ', '', config('company.phone')) }}" class="group inline-flex items-center gap-3 text-sm font-semibold">
                                <span class="flex size-9 items-center justify-center rounded-xl bg-white/15 transition group-hover:bg-white group-hover:text-primary"><i class="icon-[tabler--phone] text-lg"></i></span>
                                <span>
                                    <span class="sr-only">{{ __('Phone') }}: </span>
                                    <span>{{ config('company.phone') }}</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('contact.store') }}" class="rounded-2xl bg-base-100 p-5 shadow-xl sm:p-6" data-reveal>
                    @csrf

                    @if (session('status'))
                        <div class="alert alert-soft alert-success mb-4 flex items-center gap-3 rounded-xl text-sm" role="alert">
                            <i class="icon-[tabler--circle-check] text-2xl"></i>
                            <span>{{ session('status') }}</span>
                        </div>
                    @endif

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="field-label" for="name">{{ __('Name') }} <span class="text-error">*</span></label>
                            <div class="relative">
                                <i class="icon-[tabler--user] pointer-events-none absolute top-1/2 left-3.5 z-10 -translate-y-1/2 text-lg text-base-content/40"></i>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('Your name') }}" class="input field-shell h-11! ps-11 text-sm @error('name') is-invalid @enderror" autocomplete="name" required>
                            </div>
                            @error('name')
                                <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="field-label" for="phone">{{ __('Phone') }} <span class="text-error">*</span></label>
                            <div class="relative">
                                <i class="icon-[tabler--phone] pointer-events-none absolute top-1/2 left-3.5 z-10 -translate-y-1/2 text-lg text-base-content/40"></i>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="9911 2233" class="input field-shell h-11! ps-11 text-sm @error('phone') is-invalid @enderror" autocomplete="tel" required>
                            </div>
                            @error('phone')
                                <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="field-label" for="email">{{ __('Email') }}</label>
                            <div class="relative">
                                <i class="icon-[tabler--mail] pointer-events-none absolute top-1/2 left-3.5 z-10 -translate-y-1/2 text-lg text-base-content/40"></i>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="name@company.mn" class="input field-shell h-11! ps-11 text-sm @error('email') is-invalid @enderror" autocomplete="email">
                            </div>
                            @error('email')
                                <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            @php
                                $serviceIcons = [
                                    'Company website' => 'icon-[tabler--world-www]',
                                    'Online payments' => 'icon-[tabler--credit-card-pay]',
                                    'E-commerce' => 'icon-[tabler--shopping-bag]',
                                    'Server setup' => 'icon-[tabler--server-cog]',
                                    'Server rental' => 'icon-[tabler--cloud-computing]',
                                    'Other' => 'icon-[tabler--dots]',
                                ];

                                $serviceSelectConfig = [
                                    'placeholder' => __('Select a service'),
                                    'toggleTag' => '<button type="button" aria-expanded="false"><span class="truncate" data-title></span></button>',
                                    'toggleClasses' => 'advance-select-toggle field-shell h-11! flex items-center ps-11 pe-10 text-start text-sm'.($errors->has('service') ? ' is-invalid' : ''),
                                    'dropdownClasses' => 'advance-select-menu mt-2 max-h-80 space-y-1 overflow-y-auto rounded-2xl border border-base-300 bg-base-100 p-2 shadow-2xl shadow-primary/10',
                                    'optionClasses' => 'advance-select-option group flex items-center rounded-xl px-3 py-2.5 transition hover:bg-primary/5 selected:bg-primary/10 selected:font-semibold selected:text-primary',
                                    'optionTemplate' => '<div class="flex w-full items-center gap-3"><span class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-base-200 text-lg text-base-content/60 transition group-hover:text-primary" data-icon></span><span class="grow" data-title></span><i class="icon-[tabler--check] hidden shrink-0 text-lg text-primary selected:block"></i></div>',
                                    'extraMarkup' => '<i class="icon-[tabler--chevron-down] pointer-events-none absolute end-4 top-1/2 -translate-y-1/2 text-lg text-base-content/50"></i>',
                                ];
                            @endphp

                            <label class="field-label" for="service">{{ __('Service') }} <span class="text-error">*</span></label>
                            <div class="relative">
                                <i class="icon-[tabler--apps] pointer-events-none absolute top-1/2 left-3.5 z-20 -translate-y-1/2 text-lg text-base-content/40"></i>
                                <select id="service" name="service" class="hidden" data-select="{{ json_encode($serviceSelectConfig) }}">
                                    <option value="">{{ __('Select a service') }}</option>
                                    @foreach (\App\Http\Requests\StoreContactRequest::SERVICES as $serviceOption)
                                        <option value="{{ $serviceOption }}" data-select-option="{{ json_encode(['icon' => '<i class="'.$serviceIcons[$serviceOption].'"></i>']) }}" @selected(old('service', $preselectedService ?? null) === $serviceOption)>{{ __($serviceOption) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('service')
                                <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="field-label" for="message">{{ __('Message') }} <span class="text-error">*</span></label>
                            <textarea id="message" name="message" rows="3" placeholder="{{ __('Briefly describe your project') }}" class="textarea field-shell h-auto! min-h-24 resize-y px-4 py-3 text-sm @error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="field-error"><i class="icon-[tabler--alert-circle]"></i> {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-cta btn-block mt-5 border-0 bg-brand-gradient text-white shadow-lg shadow-primary/30 hover:opacity-90">
                        {{ __('Send request') }}
                        <i class="icon-[tabler--send] text-lg"></i>
                    </button>

                    <p class="mt-3 flex items-center justify-center gap-1.5 text-center text-xs text-base-content/50">
                        <i class="icon-[tabler--clock] text-base"></i>
                        {{ __('We usually reply within one business day.') }}
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
