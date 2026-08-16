<x-layouts::app :title="$class->name">

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div class="space-y-2">

                <div class="flex items-center gap-2">
                    <flux:button
                        href="{{ route('admin.classes.index') }}"
                        variant="ghost"
                        size="sm"
                        icon="arrow-left"
                        inset
                    >
                        Classes
                    </flux:button>
                </div>

                <flux:heading size="xl">
                    {{ $class->name }}
                </flux:heading>

                @if($class->description)
                    <flux:text class="max-w-2xl text-zinc-500">
                        {{ $class->description }}
                    </flux:text>
                @endif

            </div>

            <flux:button
                href="{{ route('admin.classes.edit', $class) }}"
                variant="primary"
                icon="pencil"
            >
                Edit Class
            </flux:button>

        </div>


        {{-- Quick Stats --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Teacher --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <flux:icon name="user" class="size-5" />
                </div>

                <div class="min-w-0">
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Teacher
                    </flux:text>

                    <flux:heading size="lg" class="truncate">
                        {{ $class->teacher->name }}
                    </flux:heading>
                </div>

            </flux:card>


            {{-- Capacity --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                    <flux:icon name="users" class="size-5" />
                </div>

                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Capacity
                    </flux:text>

                    <flux:heading size="lg">
                        {{ $class->capacity }}
                    </flux:heading>
                </div>

            </flux:card>


            {{-- Enrolled --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <flux:icon name="user-plus" class="size-5" />
                </div>

                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Enrolled
                    </flux:text>

                    <flux:heading size="lg">
                        {{ $class->students_count ?? $class->students->count() }}
                    </flux:heading>
                </div>

            </flux:card>


            {{-- Available Seats --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    <flux:icon name="ticket" class="size-5" />
                </div>

                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Available Seats
                    </flux:text>

                    <flux:heading size="lg">
                        {{ $class->availableSeats() }}
                    </flux:heading>
                </div>

            </flux:card>

        </div>


        {{-- Enrollment Overview --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <flux:heading size="lg">
                        Enrollment
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        {{ $class->students_count ?? $class->students->count() }}
                        of
                        {{ $class->capacity }}
                        seats occupied
                    </flux:text>
                </div>


                {{-- Status --}}
                @if($class->isFull())

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

            </div>


{{-- Progress --}}
<div class="mt-6">

    @php
        $percentage = $class->enrollmentPercentage();

        $barColor = match (true) {
            $percentage >= 100 => 'bg-red-500',
            $percentage >= 75 => 'bg-amber-500',
            default => 'bg-emerald-500',
        };
    @endphp

    <div class="mb-2 flex items-center justify-between">

        <flux:text class="text-sm text-zinc-500">
            Enrollment progress
        </flux:text>

        <flux:text class="text-sm font-medium">
            {{ $percentage }}%
        </flux:text>

    </div>

    <div class="h-2 w-full overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">

        <div
            class="h-full rounded-full {{ $barColor }} transition-all"
            style="width: {{ $percentage }}%"
        ></div>

    </div>

</div>

        </flux:card>


        {{-- Teacher & Class Information --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Class Information --}}
            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                <flux:heading size="lg">
                    Class Information
                </flux:heading>

                <div class="mt-5 divide-y divide-zinc-200 dark:divide-zinc-800">

                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Class name
                        </flux:text>

                        <flux:text class="font-medium">
                            {{ $class->name }}
                        </flux:text>

                    </div>

                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Capacity
                        </flux:text>

                        <flux:text class="font-medium">
                            {{ $class->capacity }} students
                        </flux:text>

                    </div>

                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Enrolled
                        </flux:text>

                        <flux:text class="font-medium">
                            {{ $class->students_count ?? $class->students->count() }}
                        </flux:text>

                    </div>

                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Available seats
                        </flux:text>

                        <flux:text class="font-medium">
                            {{ $class->availableSeats() }}
                        </flux:text>

                    </div>

                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Status
                        </flux:text>

                        @if($class->isFull())
                            <flux:badge color="red">
                                Full
                            </flux:badge>
                        @else
                            <flux:badge color="emerald">
                                Available
                            </flux:badge>
                        @endif

                    </div>

                </div>

            </flux:card>


            {{-- Teacher Information --}}
            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                <flux:heading size="lg">
                    Teacher
                </flux:heading>

                <div class="mt-5 flex items-center gap-4">

                    <div class="flex size-14 shrink-0 items-center justify-center rounded-full bg-blue-50 text-lg font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        {{ collect(explode(' ', $class->teacher->name))
                            ->map(fn ($part) => $part[0] ?? '')
                            ->take(2)
                            ->implode('') }}
                    </div>

                    <div class="min-w-0">

                        <flux:heading size="lg">
                            {{ $class->teacher->name }}
                        </flux:heading>

                        @if($class->teacher->email)
                            <flux:text class="mt-1 text-zinc-500">
                                {{ $class->teacher->email }}
                            </flux:text>
                        @endif

                    </div>

                </div>

                <div class="mt-6">

                    <flux:button
                        href="{{ route('admin.teachers.show', $class->teacher) }}"
                        variant="ghost"
                        icon="arrow-right"
                    >
                        View Teacher
                    </flux:button>

                </div>

            </flux:card>

        </div>


        {{-- Students --}}
        <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <flux:heading size="lg">
                            Students
                        </flux:heading>

                        <flux:text class="mt-1 text-zinc-500">
                            Students currently enrolled in this class.
                        </flux:text>
                    </div>

                    <flux:badge color="zinc">
                        {{ $class->students_count ?? $class->students->count() }}
                        students
                    </flux:badge>

                </div>

            </div>


            @if($class->students->count())

                <div class="divide-y divide-zinc-200 dark:divide-zinc-800">

                    @foreach($class->students as $student)

                        <div class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-900">

                            <div class="flex min-w-0 items-center gap-3">

                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-sm font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ collect(explode(' ', $student->name))
                                        ->map(fn ($part) => $part[0] ?? '')
                                        ->take(2)
                                        ->implode('') }}
                                </div>

                                <div class="min-w-0">

                                    <flux:text class="truncate font-medium">
                                        {{ $student->name }}
                                    </flux:text>

                                    @if($student->email)
                                        <flux:text class="truncate text-sm text-zinc-500">
                                            {{ $student->email }}
                                        </flux:text>
                                    @endif

                                </div>

                            </div>

                            <flux:button
                                href="{{ route('admin.students.show', $student) }}"
                                variant="ghost"
                                size="sm"
                                icon="chevron-right"
                                inset
                            />

                        </div>

                    @endforeach

                </div>

            @else

                <div class="flex flex-col items-center justify-center px-6 py-16 text-center">

                    <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900">

                        <flux:icon
                            name="users"
                            class="size-6 text-zinc-400"
                        />

                    </div>

                    <flux:heading size="sm">
                        No students enrolled
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        This class currently has no students assigned.
                    </flux:text>

                    <flux:button
                        href="{{ route('admin.classes.edit', $class) }}"
                        variant="ghost"
                        class="mt-4"
                        icon="plus"
                    >
                        Add Students
                    </flux:button>

                </div>

            @endif

        </flux:card>




    </div>

</x-layouts::app>
