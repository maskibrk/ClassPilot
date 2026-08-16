<div class="space-y-6">

    {{-- Search + filters --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

        <flux:field class="flex-1">
            <div class="relative">
                <flux:input
                    type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search by class name or teacher..."
                    icon="magnifying-glass"
                />

                <div
                    wire:loading
                    wire:target="search"
                    class="absolute right-3 top-1/2 -translate-y-1/2"
                >
                    <flux:icon
                        name="arrow-path"
                        class="size-4 animate-spin text-zinc-400"
                    />
                </div>
            </div>
        </flux:field>

        <flux:select wire:model.live="statusFilter" placeholder="All statuses" class="sm:w-48">
            <flux:select.option value="">All statuses</flux:select.option>
            <flux:select.option value="available">Available</flux:select.option>
            <flux:select.option value="full">Full</flux:select.option>
        </flux:select>

    </div>

    {{-- Table --}}
    <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900">

                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Class
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Teacher
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Enrollment
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">

                    @forelse($classes as $class)

                        @php
                            $isFull = $class->students_count >= $class->capacity;
                            $pct = $class->capacity > 0
                                ? min(100, (int) round(($class->students_count / $class->capacity) * 100))
                                : 0;
                            $barColor = match (true) {
                                $pct >= 100 => 'bg-red-500',
                                $pct >= 75 => 'bg-amber-500',
                                default => 'bg-emerald-500',
                            };
                        @endphp

                        <tr
                            wire:key="class-{{ $class->id }}"
                            class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-900"
                        >

                            {{-- Name --}}
                            <td class="px-6 py-4">
                                <a
                                    href="{{ route('admin.classes.show', $class) }}"
                                    class="font-medium text-zinc-900 hover:text-blue-600 hover:underline dark:text-zinc-100 dark:hover:text-blue-400"
                                >
                                    {{ $class->name }}
                                </a>
                            </td>


                            {{-- Teacher --}}
                            <td class="px-6 py-4">
                                <a
                                    href="{{ route('admin.teachers.show', $class->teacher) }}"
                                    class="flex items-center gap-2 text-zinc-600 hover:text-blue-600 hover:underline dark:text-zinc-400 dark:hover:text-blue-400"
                                >
                                    <span class="flex size-7 items-center justify-center rounded-full bg-zinc-100 text-xs font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                                        {{ collect(explode(' ', $class->teacher->name))->map(fn ($p) => $p[0] ?? '')->take(2)->implode('') }}
                                    </span>
                                    {{ $class->teacher->name }}
                                </a>
                            </td>


                            {{-- Enrollment (students / capacity + progress bar) --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-1.5 w-24 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                                        <div class="h-full rounded-full {{ $barColor }}" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <flux:text class="whitespace-nowrap text-zinc-600 dark:text-zinc-400">
                                        {{ $class->students_count }} / {{ $class->capacity }}
                                    </flux:text>
                                </div>
                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if (! $isFull)

                                    <flux:badge
                                        color="emerald"
                                        icon="check-circle"
                                    >
                                        Available
                                    </flux:badge>

                                @else

                                    <flux:badge
                                        color="red"
                                        icon="x-circle"
                                    >
                                        Full
                                    </flux:badge>

                                @endif

                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
                                <flux:button
                                    href="{{ route('admin.classes.show', $class) }}"
                                    variant="ghost"
                                    size="sm"
                                    icon="chevron-right"
                                    inset
                                />
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="px-6 py-16">

                                <div class="flex flex-col items-center justify-center text-center">

                                    <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900">
                                        <flux:icon
                                            name="magnifying-glass"
                                            class="size-6 text-zinc-400"
                                        />
                                    </div>

                                    <flux:heading size="sm">
                                        No classes found
                                    </flux:heading>

                                    <flux:text class="mt-1 text-zinc-500">
                                        Try adjusting your search or filters.
                                    </flux:text>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($classes->hasPages())

            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
                {{ $classes->links() }}
            </div>

        @endif

    </flux:card>

</div>
