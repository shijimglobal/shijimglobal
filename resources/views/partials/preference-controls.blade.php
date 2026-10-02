{{-- Language switcher and dark mode toggle shared by the auth, admin and error layouts. --}}
@php
    $currentLocale = app()->getLocale();
    $dropdownId = 'locale-dropdown-'.($id ?? 'default');
@endphp

<div class="flex items-center gap-1">
    <div class="dropdown relative inline-flex [--placement:bottom-end]">
        <button id="{{ $dropdownId }}" type="button" class="dropdown-toggle btn btn-text h-10 min-h-10 gap-1.5 rounded-xl px-3 text-sm font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="{{ __('Change language') }}">
            <i class="icon-[tabler--world] text-lg"></i>
            {{ $currentLocale }}
            <i class="icon-[tabler--chevron-down] text-sm transition-transform dropdown-open:rotate-180"></i>
        </button>
        <ul class="dropdown-menu hidden min-w-44 rounded-2xl border border-base-300 p-2 shadow-xl dropdown-open:opacity-100" role="menu" aria-orientation="vertical" aria-labelledby="{{ $dropdownId }}">
            @foreach (config('company.locales') as $localeCode => $localeName)
                <li>
                    <a href="{{ route('locale.switch', $localeCode) }}" class="dropdown-item justify-between rounded-xl {{ $localeCode === $currentLocale ? 'bg-primary/10 font-semibold text-primary' : '' }}">
                        {{ $localeName }}
                        <span class="text-xs font-bold uppercase opacity-60">{{ $localeCode }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <button type="button" data-theme-toggle class="btn btn-text btn-square size-10 min-h-10 rounded-xl" aria-label="{{ __('Toggle dark mode') }}">
        <i class="icon-[tabler--moon] text-xl dark:hidden"></i>
        <i class="icon-[tabler--sun] hidden text-xl dark:inline-block"></i>
    </button>
</div>
