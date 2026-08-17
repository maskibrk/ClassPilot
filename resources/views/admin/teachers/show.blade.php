<x-layouts::app :title="$teacher->name">

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        <div class="space-y-2">

            <div class="flex items-center gap-2">

                <flux:button
                    href="{{ route('admin.teachers.index') }}"
                    variant="ghost"
                    size="sm"
                    icon="arrow-left"
                    inset
                >
                    Teachers
                </flux:button>

            </div>

            <flux:heading size="xl">
                {{ $teacher->name }}
            </flux:heading>

            <flux:text class="text-zinc-500">
                Teacher profile, classes, and assigned students.
            </flux:text>

        </div>

        <flux:button
            href="{{ route('admin.teachers.edit', $teacher) }}"
            variant="primary"
            icon="pencil"
        >
            Edit Teacher
        </flux:button>

    </div>


    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Students --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                <flux:icon name="users" class="size-5" />
            </div>

            <div>

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Students
                </flux:text>

                <flux:heading size="lg">
                    {{ $teacher->students->count() }}
                </flux:heading>

            </div>

        </flux:card>


        {{-- Classes --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                <flux:icon name="academic-cap" class="size-5" />
            </div>

            <div>

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Classes
                </flux:text>

                <flux:heading size="lg">
                    {{ $teacher->classes->count() }}
                </flux:heading>

            </div>

        </flux:card>


        {{-- Email --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                <flux:icon name="envelope" class="size-5" />
            </div>

            <div class="min-w-0">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Email
                </flux:text>

                <flux:text class="truncate font-medium">
                    {{ $teacher->email }}
                </flux:text>

            </div>

        </flux:card>


        {{-- Phone --}}
        <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                <flux:icon name="phone" class="size-5" />
            </div>

            <div class="min-w-0">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Phone
                </flux:text>

                <flux:text class="truncate font-medium">
                    {{ $teacher->phone ?? 'Not provided' }}
                </flux:text>

            </div>

        </flux:card>

    </div>


    {{-- Teacher Information --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Information --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <flux:heading size="lg">
                Teacher Information
            </flux:heading>

            <div class="mt-5 divide-y divide-zinc-200 dark:divide-zinc-800">

                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Name
                    </flux:text>

                    <flux:text class="text-right font-medium">
                        {{ $teacher->name }}
                    </flux:text>

                </div>


                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Email
                    </flux:text>

                    <flux:text class="text-right font-medium">
                        {{ $teacher->email }}
                    </flux:text>

                </div>


                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Phone
                    </flux:text>

                    <flux:text class="text-right font-medium">
                        {{ $teacher->phone ?? 'Not provided' }}
                    </flux:text>

                </div>


                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Students
                    </flux:text>

                    <flux:badge color="zinc">
                        {{ $teacher->students->count() }}
                    </flux:badge>

                </div>


                <div class="flex items-center justify-between gap-4 py-3">

                    <flux:text class="text-zinc-500">
                        Classes
                    </flux:text>

                    <flux:badge color="zinc">
                        {{ $teacher->classes->count() }}
                    </flux:badge>

                </div>

            </div>

        </flux:card>


        {{-- Profile --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <flux:heading size="lg">
                Teacher
            </flux:heading>

            <div class="mt-5 flex items-center gap-4">

                <div class="flex size-14 shrink-0 items-center justify-center rounded-full bg-blue-50 text-lg font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">

                    {{ collect(explode(' ', $teacher->name))
                        ->map(fn ($part) => $part[0] ?? '')
                        ->take(2)
                        ->implode('') }}

                </div>

                <div class="min-w-0">

                    <flux:heading size="lg">
                        {{ $teacher->name }}
                    </flux:heading>

                    <flux:text class="mt-1 truncate text-zinc-500">
                        {{ $teacher->email }}
                    </flux:text>

                </div>

            </div>


            <div class="mt-6 flex gap-2">

                <flux:button
                    href="{{ route('admin.teachers.edit', $teacher) }}"
                    variant="ghost"
                    icon="pencil"
                >
                    Edit Profile
                </flux:button>

            </div>

        </flux:card>

    </div>


    {{-- Assigned Classes --}}
    <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <flux:heading size="lg">
                        Assigned Classes
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        Classes currently assigned to this teacher.
                    </flux:text>

                </div>

                <flux:badge color="zinc">
                    {{ $teacher->classes->count() }}
                    {{ Str::plural('class', $teacher->classes->count()) }}
                </flux:badge>

            </div>

        </div>


        @if($teacher->classes->count())

            <div class="divide-y divide-zinc-200 dark:divide-zinc-800">

                @foreach($teacher->classes as $class)

                    <div class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-zinc-50 dark:hover:bg-zinc-900">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">

                                <flux:icon
                                    name="academic-cap"
                                    class="size-5"
                                />

                            </div>


                            <div class="min-w-0">

                                <flux:text class="truncate font-medium">
                                    {{ $class->name }}
                                </flux:text>

                                <flux:text class="text-sm text-zinc-500">
                                    {{ $class->students->count() }}
                                    {{ Str::plural('student', $class->students->count()) }}

                                    @if($class->code)
                                        · {{ $class->code }}
                                    @endif
                                </flux:text>

                            </div>

                        </div>


                        <flux:button
                            href="{{ route('admin.classes.show', $class) }}"
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
                        name="academic-cap"
                        class="size-6 text-zinc-400"
                    />

                </div>

                <flux:heading size="sm">
                    No classes assigned
                </flux:heading>

                <flux:text class="mt-1 text-zinc-500">
                    This teacher currently has no classes assigned.
                </flux:text>

            </div>

        @endif

    </flux:card>


    {{-- Assigned Students --}}
    <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

        <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <flux:heading size="lg">
                        Assigned Students
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        Students currently assigned to this teacher.
                    </flux:text>

                </div>

                <flux:badge color="zinc">
                    {{ $teacher->students->count() }}
                    {{ Str::plural('student', $teacher->students->count()) }}
                </flux:badge>

            </div>

        </div>


        @if($teacher->students->count())

            <div class="divide-y divide-zinc-200 dark:divide-zinc-800">

                @foreach($teacher->students as $student)

                    <div class="flex items-center justify-between gap-4 px-6 py-4 transition hover:bg-zinc-50 dark:hover:bg-zinc-900">

                        <div class="flex min-w-0 items-center gap-3">

                            {{-- Avatar --}}
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


                        <div class="flex items-center gap-3">

                            @if($student->status)

                                <flux:badge
                                    color="{{ $student->status === 'active' ? 'emerald' : 'zinc' }}"
                                    class="hidden sm:inline-flex"
                                >
                                    {{ ucfirst($student->status) }}
                                </flux:badge>

                            @endif


                            <flux:button
                                href="{{ route('admin.students.show', $student) }}"
                                variant="ghost"
                                size="sm"
                                icon="chevron-right"
                                inset
                            />

                        </div>

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
                    No students assigned
                </flux:heading>

                <flux:text class="mt-1 text-zinc-500">
                    This teacher currently has no students assigned.
                </flux:text>

                <flux:button
                    href="{{ route('admin.teachers.edit', $teacher) }}"
                    variant="ghost"
                    class="mt-4"
                    icon="plus"
                >
                    Assign Students
                </flux:button>

            </div>

        @endif

    </flux:card>

</div>

</x-layouts::app>
