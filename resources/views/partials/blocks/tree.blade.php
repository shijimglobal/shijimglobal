{{--
    Tree diagram: a root dot branches into two columns of gradient-labelled nodes
    (joined top to bottom), and both columns merge into one result.
    The brackets are 50% + half the column gap wide, so their ends sit exactly over the column centres.
--}}
@php
    $nodes = array_values($block['nodes']);
    $columns = [
        array_values(array_filter($nodes, fn (int $index): bool => $index % 2 === 0, ARRAY_FILTER_USE_KEY)),
        array_values(array_filter($nodes, fn (int $index): bool => $index % 2 === 1, ARRAY_FILTER_USE_KEY)),
    ];
@endphp

<section class="py-12 sm:py-16" data-reveal>
    <h2 class="text-center text-2xl font-extrabold tracking-tight sm:text-4xl">{{ $block['title'] }}</h2>

    <div class="mx-auto mt-10 max-w-4xl">
        {{-- Root --}}
        <span class="relative z-10 mx-auto block size-5 rounded-full bg-brand-gradient shadow-lg shadow-primary/40 ring-4 ring-primary/15"></span>
        <div class="mx-auto -mt-2.5 hidden h-12 w-[calc(50%+1.5rem)] rounded-t-3xl border-x-2 border-t-2 border-base-content/20 sm:block"></div>
        <span class="mx-auto block h-8 w-0.5 bg-base-content/20 sm:hidden"></span>

        {{-- Two columns of nodes --}}
        <div class="grid gap-x-12 sm:grid-cols-2">
            @foreach ($columns as $columnIndex => $columnNodes)
                <div class="flex flex-col items-center text-center">
                    @foreach ($columnNodes as $node)
                        <div class="flex flex-col items-center" data-reveal style="--reveal-delay: {{ ($loop->index * 2 + $columnIndex) * 150 }}ms">
                            <span class="rounded-xl bg-brand-gradient px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/25">{{ $node['label'] }}</span>
                            <p class="mt-3 max-w-[16rem] text-sm leading-relaxed text-base-content/70 sm:text-base">{{ $node['text'] }}</p>
                        </div>

                        {{-- Connector to the next node in this column (and between the columns on phones) --}}
                        @if (! $loop->last || ($columnIndex === 0))
                            <span @class([
                                'my-5 flex flex-col items-center',
                                'sm:hidden' => $loop->last,
                            ])>
                                <span class="size-2 rounded-full border-2 border-base-content/30 bg-base-100"></span>
                                <span class="h-10 w-0.5 bg-base-content/20"></span>
                                <span class="size-2 rounded-full border-2 border-base-content/30 bg-base-100"></span>
                            </span>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

        {{-- Merge into the result --}}
        <div class="mx-auto mt-6 hidden h-12 w-[calc(50%+1.5rem)] rounded-b-3xl border-x-2 border-b-2 border-base-content/20 sm:block"></div>
        <span class="mx-auto mt-6 block h-8 w-0.5 bg-base-content/20 sm:hidden"></span>
        <span class="relative z-10 mx-auto -mt-2 block size-4 rounded-full bg-base-content"></span>

        <div class="mt-6 text-center">
            <span class="inline-block rounded-xl bg-brand-gradient px-6 py-2 text-sm font-semibold text-white shadow-lg shadow-primary/25">{{ $block['result']['label'] }}</span>
            <p class="mx-auto mt-3 max-w-sm text-sm leading-relaxed font-medium sm:text-base">{{ $block['result']['text'] }}</p>
        </div>
    </div>
</section>
