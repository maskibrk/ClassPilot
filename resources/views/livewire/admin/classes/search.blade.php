
<div class="space-y-6">
        {{-- Quick stats --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <flux:icon name="academic-cap" class="size-5" />
                </div>
                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">Total Classes</flux:text>
                    <flux:heading size="lg">{{ $totalClasses ?? '—' }}</flux:heading>
                </div>
            </flux:card>

            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <flux:icon name="users" class="size-5" />
                </div>
                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">Available Seats</flux:text>
                    <flux:heading size="lg">{{  $totalAvailableSeats ?? '—' }}</flux:heading>
                </div>
            </flux:card>

            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    <flux:icon name="exclamation-triangle" class="size-5" />
                </div>
                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">Full Classes</flux:text>
                    <flux:heading size="lg">{{ $fullClasses ?? '—' }}</flux:heading>
                </div>
            </flux:card>

        </div>
    {{-- Search --}}
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

    {{-- Status Filter --}}
    <flux:select
        wire:model.live="status"
        class="w-full sm:w-48"
    >
        <flux:select.option value="">All statuses</flux:select.option>
        <flux:select.option value="available">Available</flux:select.option>
        <flux:select.option value="full">Full</flux:select.option>
    </flux:select>

    </div>


    {{-- Table --}}
    <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- Table Header --}}
                <thead
                    class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900"
                >
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


                {{-- Table Body --}}
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">

                    @forelse($classes as $class)

                        <tr
                            wire:key="class-{{ $class->id }}"
                            class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-900"
                        >

                            {{-- Class Name --}}
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

                                    <span
                                        class="flex size-7 items-center justify-center rounded-full bg-zinc-100 text-xs font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300"
                                    >
                                        {{ collect(explode(' ', $class->teacher->name))
                                            ->map(fn ($p) => $p[0] ?? '')
                                            ->take(2)
                                            ->implode('') }}
                                    </span>

                                    {{ $class->teacher->name }}

                                </a>

                            </td>


{{-- Enrollment --}}
<td class="px-6 py-4">
    <div class="flex items-center gap-3">

        @php
            $percentage = $class->enrollmentPercentage();

            $barColor = match (true) {
                $percentage >= 100 => 'bg-red-500',
                $percentage >= 75 => 'bg-amber-500',
                default => 'bg-emerald-500',
            };
        @endphp

        {{-- Progress Bar --}}
        <div class="w-24 h-2 bg-zinc-200 rounded-full overflow-hidden dark:bg-zinc-700">
            <div
                class="h-full {{ $barColor }} rounded-full"
                style="width: {{ $percentage }}%"
            ></div>
        </div>

        {{-- Student Count --}}
        <flux:text class="whitespace-nowrap text-zinc-600 dark:text-zinc-400">
            {{ $class->students_count }} / {{ $class->capacity }}
        </flux:text>

    </div>
</td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if ($class->isFull())

                                    <flux:badge
                                        color="red"
                                        icon="x-circle"
                                    >
                                        Full
                                    </flux:badge>

                                @else

                                    <flux:badge
                                        color="emerald"
                                        icon="check-circle"
                                    >
                                        Available
                                    </flux:badge>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">
        {{-- Edit --}}
        <flux:button
            href="{{ route('admin.classes.edit', $class) }}"
            variant="ghost"
            size="sm"
            icon="pencil"
            inset
        >
            Edit
        </flux:button>
                            </td>

                        </tr>


                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td
                                colspan="5"
                                class="px-6 py-16"
                            >

                                <div class="flex flex-col items-center justify-center text-center">

                                    <div
                                        class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900"
                                    >
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
