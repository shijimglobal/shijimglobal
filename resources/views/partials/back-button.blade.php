{{-- Goes back to the previous page on this site; visitors arriving from elsewhere go to $fallbackUrl instead. --}}
<a href="{{ $fallbackUrl ?? route('home') }}" data-back-button class="group inline-flex items-center gap-2 rounded-xl border border-base-300 bg-base-100/80 px-3.5 py-2 text-sm font-semibold text-base-content/70 shadow-sm transition hover:border-primary/40 hover:text-primary">
    <i class="icon-[tabler--arrow-left] text-base transition-transform duration-300 group-hover:-translate-x-0.5"></i>
    {{ __('Back') }}
</a>
