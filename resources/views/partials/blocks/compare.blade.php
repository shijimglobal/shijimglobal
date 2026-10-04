{{-- Comparison table with one highlighted (recommended) column. Scrolls sideways on small screens. --}}
@php $highlightedColumn = $block['highlight'] ?? null; @endphp

<section class="py-12 sm:py-16" data-reveal>
    <h2 class="text-center text-2xl font-extrabold tracking-tight sm:text-4xl">{{ $block['title'] }}</h2>

    <div class="mt-10 -mx-4 overflow-x-auto px-4 pb-2">
        <table class="w-full min-w-[40rem] border-separate border-spacing-x-3 border-spacing-y-0 text-sm sm:text-base">
            <thead>
                <tr>
                    <th class="w-32"></th>
                    @foreach ($block['columns'] as $columnIndex => $column)
                        <th scope="col" @class([
                            'rounded-t-2xl px-4 py-4 text-center font-bold',
                            'bg-brand-gradient text-white' => $columnIndex === $highlightedColumn,
                            'bg-base-200 text-base-content/80' => $columnIndex !== $highlightedColumn,
                        ])>
                            {{ $column }}
                            @if ($columnIndex === $highlightedColumn)
                                <span class="mt-1 block text-xs font-semibold text-white/80">{{ __('Recommended') }}</span>
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($block['rows'] as $row)
                    <tr>
                        <th scope="row" class="py-4 pe-2 text-start font-semibold text-base-content/60">{{ $row['label'] }}</th>
                        @foreach ($row['values'] as $columnIndex => $value)
                            <td @class([
                                'border-b border-base-300/60 px-4 py-4 text-center',
                                'bg-primary/5 font-semibold text-primary' => $columnIndex === $highlightedColumn,
                                'bg-base-100' => $columnIndex !== $highlightedColumn,
                                'rounded-b-2xl border-b-0' => $loop->parent->last,
                            ])>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
