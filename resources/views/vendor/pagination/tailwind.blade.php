@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center justify-between gap-4 sm:flex-row">

        {{-- Results summary --}}
        <flux:text class="text-zinc-500">
            @if ($paginator->firstItem())
                Showing
                <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $paginator->total() }}</span>
                results
            @else
                {{ $paginator->total() }} {{ Str::plural('result', $paginator->total()) }}
            @endif
        </flux:text>

        {{-- Page links --}}
        <div class="flex items-center gap-1">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span
                    aria-disabled="true"
                    class="flex size-9 items-center justify-center rounded-lg text-zinc-300 dark:text-zinc-600"
                >
                    <flux:icon name="chevron-left" class="size-4" />
                </span>
            @else
                <button
                    type="button"
                    wire:click="previousPage"
                    wire:loading.attr="disabled"
                    rel="prev"
                    class="flex size-9 items-center justify-center rounded-lg text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100"
                >
                    <flux:icon name="chevron-left" class="size-4" />
                </button>
            @endif

            {{-- Elements --}}
            @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="flex size-9 items-center justify-center text-sm text-zinc-400">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                aria-current="page"
                                class="flex size-9 items-center justify-center rounded-lg bg-zinc-900 text-sm font-semibold text-white dark:bg-white dark:text-zinc-900"
                            >
                                {{ $page }}
                            </span>
                        @else
                            <button
                                type="button"
                                wire:click="gotoPage({{ $page }})"
                                wire:loading.attr="disabled"
                                class="flex size-9 items-center justify-center rounded-lg text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100"
                            >
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <button
                    type="button"
                    wire:click="nextPage"
                    wire:loading.attr="disabled"
                    rel="next"
                    class="flex size-9 items-center justify-center rounded-lg text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100"
                >
                    <flux:icon name="chevron-right" class="size-4" />
                </button>
            @else
                <span
                    aria-disabled="true"
                    class="flex size-9 items-center justify-center rounded-lg text-zinc-300 dark:text-zinc-600"
                >
                    <flux:icon name="chevron-right" class="size-4" />
                </span>
            @endif

        </div>

    </nav>
@endif
