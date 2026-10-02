@if ($paginator->hasPages())
    <nav class="flex flex-col items-center justify-between gap-3 sm:flex-row" aria-label="{{ __('Pagination') }}">
        <p class="text-sm text-base-content/60">
            {{ __('Showing :from–:to of :total', ['from' => $paginator->firstItem(), 'to' => $paginator->lastItem(), 'total' => $paginator->total()]) }}
        </p>

        <div class="flex items-center gap-1">
            @if ($paginator->onFirstPage())
                <span class="flex size-10 items-center justify-center rounded-xl text-base-content/30"><i class="icon-[tabler--chevron-left] text-lg"></i></span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="flex size-10 items-center justify-center rounded-xl text-base-content/70 transition hover:bg-base-200 hover:text-primary" aria-label="{{ __('Previous') }}"><i class="icon-[tabler--chevron-left] text-lg"></i></a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="flex size-10 items-center justify-center text-base-content/40">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="flex size-10 items-center justify-center rounded-xl bg-brand-gradient text-sm font-bold text-white shadow-md shadow-primary/25" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex size-10 items-center justify-center rounded-xl text-sm font-semibold text-base-content/70 transition hover:bg-base-200 hover:text-primary">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="flex size-10 items-center justify-center rounded-xl text-base-content/70 transition hover:bg-base-200 hover:text-primary" aria-label="{{ __('Next') }}"><i class="icon-[tabler--chevron-right] text-lg"></i></a>
            @else
                <span class="flex size-10 items-center justify-center rounded-xl text-base-content/30"><i class="icon-[tabler--chevron-right] text-lg"></i></span>
            @endif
        </div>
    </nav>
@endif
