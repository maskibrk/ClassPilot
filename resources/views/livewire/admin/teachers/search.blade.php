<div class="space-y-6">

{{-- Quick Stats --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

    {{-- Total Teachers --}}
    <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
            <flux:icon name="user-group" class="size-5" />
        </div>

        <div>

            <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                Total Teachers
            </flux:text>

            <flux:heading size="lg">
                {{ $totalTeachers ?? '—' }}
            </flux:heading>

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
                placeholder="Search by teacher name or email..."
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

</div>


{{-- Table --}}
<flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            {{-- Header --}}
            <thead class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900">

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Teacher
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Email
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        Students
                    </th>

                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-zinc-500">
                        <span class="sr-only">Actions</span>
                    </th>

                </tr>

            </thead>


            {{-- Body --}}
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">

                @forelse($teachers as $teacher)

                    <tr
                        wire:key="teacher-{{ $teacher->id }}"
                        class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-900"
                    >

                        {{-- Teacher --}}
                        <td class="px-6 py-4">

                            <a
                                href="{{ route('admin.teachers.show', $teacher) }}"
                                class="flex items-center gap-3"
                            >

                                <span
                                    class="flex size-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400"
                                >
                                    {{ collect(explode(' ', $teacher->name))
                                        ->map(fn ($p) => $p[0] ?? '')
                                        ->take(2)
                                        ->implode('') }}
                                </span>

                                <span class="font-medium text-zinc-900 hover:text-blue-600 hover:underline dark:text-zinc-100 dark:hover:text-blue-400">
                                    {{ $teacher->name }}
                                </span>

                            </a>

                        </td>


                        {{-- Email --}}
                        <td class="px-6 py-4">

                            <flux:text class="text-zinc-600 dark:text-zinc-400">
                                {{ $teacher->email }}
                            </flux:text>

                        </td>


                        {{-- Students --}}
                        <td class="px-6 py-4">

                            <flux:badge
                                color="{{ $teacher->students_count > 0 ? 'emerald' : 'zinc' }}"
                                size="sm"
                                icon="users"
                            >
                                {{ $teacher->students_count }}
                            </flux:badge>

                        </td>


                        {{-- Actions --}}
                        <td class="px-6 py-4 text-right">

        {{-- Edit --}}
        <flux:button
            href="{{ route('admin.teachers.edit', $teacher) }}"
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
                            colspan="4"
                            class="px-6 py-16"
                        >

                            <div class="flex flex-col items-center justify-center text-center">

                                <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900">

                                    <flux:icon
                                        name="magnifying-glass"
                                        class="size-6 text-zinc-400"
                                    />

                                </div>

                                <flux:heading size="sm">
                                    No teachers found
                                </flux:heading>

                                <flux:text class="mt-1 text-zinc-500">
                                    Try adjusting your search.
                                </flux:text>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    @if($teachers->hasPages())

        <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">
            {{ $teachers->links() }}
        </div>

    @endif

</flux:card>

</div>
