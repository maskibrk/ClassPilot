<div class="space-y-6">
{{-- Quick Stats --}}
<div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

    {{-- Total Students --}}
    <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
            <flux:icon name="users" class="size-5" />
        </div>

        <div>

            <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                Total Students
            </flux:text>

            <flux:heading size="lg">
                {{ $totalStudents ?? '—' }}
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
                    placeholder="Search by student name..."
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


    {{-- Students Table --}}
    <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- Header --}}
                <thead
                    class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900"
                >

                    <tr>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Student
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Teachers
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Parent
                        </th>

                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            Status
                        </th>

                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-zinc-500">
                            <span class="sr-only">Actions</span>
                        </th>

                    </tr>

                </thead>


                {{-- Body --}}
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">

                    @forelse($students as $student)

                        <tr
                            wire:key="student-{{ $student->id }}"
                            class="transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-900"
                        >

                            {{-- Student --}}
                            <td class="px-6 py-4">

                                <a
                                    href="{{ route('admin.students.show', $student) }}"
                                    class="flex items-center gap-3"
                                >

                                    {{-- Avatar --}}
                                    <span
                                        class="flex size-9 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-sm font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300"
                                    >
                                        {{ collect(explode(' ', $student->name))
                                            ->map(fn ($part) => $part[0] ?? '')
                                            ->take(2)
                                            ->implode('') }}
                                    </span>


                                    <span class="min-w-0">

                                        <span
                                            class="block font-medium text-zinc-900 hover:text-blue-600 hover:underline dark:text-zinc-100 dark:hover:text-blue-400"
                                        >
                                            {{ $student->name }}
                                        </span>

                                        @if($student->email)

                                            <span class="block truncate text-sm text-zinc-500">
                                                {{ $student->email }}
                                            </span>

                                        @endif

                                    </span>

                                </a>

                            </td>


                            {{-- Teachers --}}
                            <td class="px-6 py-4">

                                @if($student->teachers->count())

                                    <div class="flex flex-wrap gap-1.5">

                                        @foreach($student->teachers as $teacher)

                                            <a
                                                href="{{ route('admin.teachers.show', $teacher) }}"
                                                class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 hover:bg-blue-100 dark:bg-blue-500/10 dark:text-blue-400 dark:hover:bg-blue-500/20"
                                            >
                                                {{ $teacher->name }}
                                            </a>

                                        @endforeach

                                    </div>

                                @else

                                    <flux:text class="text-zinc-500">
                                        No teacher
                                    </flux:text>

                                @endif

                            </td>


                            {{-- Parent --}}
                            <td class="px-6 py-4">

                                @if($student->parent)

                                    <a
                                        href="{{ route('admin.parents.show', $student->parent) }}"
                                        class="font-medium text-zinc-700 hover:text-blue-600 hover:underline dark:text-zinc-300 dark:hover:text-blue-400"
                                    >
                                        {{ $student->parent->name }}
                                    </a>

                                @else

                                    <flux:text class="text-zinc-500">
                                        No parent
                                    </flux:text>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-6 py-4">

                                @if($student->status === 'active')

                                    <flux:badge
                                        color="emerald"
                                        icon="check-circle"
                                    >
                                        Active
                                    </flux:badge>

                                @else

                                    <flux:badge
                                        color="zinc"
                                    >
                                        {{ ucfirst($student->status) }}
                                    </flux:badge>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">

        {{-- Edit --}}
        <flux:button
            href="{{ route('admin.students.edit', $student) }}"
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
                                            name="users"
                                            class="size-6 text-zinc-400"
                                        />

                                    </div>


                                    <flux:heading size="sm">
                                        No students found
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
        @if($students->hasPages())

            <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-800">

                {{ $students->links() }}

            </div>

        @endif

    </flux:card>

</div>
