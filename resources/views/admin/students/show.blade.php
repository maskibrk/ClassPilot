<x-layouts::app :title="$student->name">

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div class="space-y-2">

                <div>
                    <flux:button
                        href="{{ route('admin.students.index') }}"
                        variant="ghost"
                        size="sm"
                        icon="arrow-left"
                        inset
                    >
                        Students
                    </flux:button>
                </div>

                <flux:heading size="xl">
                    {{ $student->name }}
                </flux:heading>

                <flux:text class="text-zinc-500">
                    Student Profile
                </flux:text>

            </div>


            <flux:button
                href="{{ route('admin.students.edit', $student) }}"
                variant="primary"
                icon="pencil"
            >
                Edit Student
            </flux:button>

        </div>


        {{-- Quick Stats --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Status --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <flux:icon name="check-circle" class="size-5" />
                </div>

                <div>

                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Status
                    </flux:text>

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
                            icon="minus-circle"
                        >
                            Inactive
                        </flux:badge>

                    @endif

                </div>

            </flux:card>


            {{-- Parent --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                    <flux:icon name="user" class="size-5" />
                </div>

                <div class="min-w-0">

                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Parent
                    </flux:text>

                    @if($student->parent)

                        <flux:heading size="lg" class="truncate">
                            {{ $student->parent->name }}
                        </flux:heading>

                    @else

                        <flux:text>
                            Not assigned
                        </flux:text>

                    @endif

                </div>

            </flux:card>


            {{-- Teachers --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <flux:icon name="academic-cap" class="size-5" />
                </div>

                <div>

                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Teachers
                    </flux:text>

                    <flux:heading size="lg">
                        {{ $student->teachers->count() }}
                    </flux:heading>

                </div>

            </flux:card>


            {{-- Join Date --}}
            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    <flux:icon name="calendar" class="size-5" />
                </div>

                <div>

                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                        Joined
                    </flux:text>

                    <flux:heading size="lg">
                        {{ optional($student->join_date)->format('M d, Y') ?? '-' }}
                    </flux:heading>

                </div>

            </flux:card>

        </div>


        {{-- Information --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Student Information --}}
            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                <flux:heading size="lg">
                    Student Information
                </flux:heading>

                <div class="mt-5 divide-y divide-zinc-200 dark:divide-zinc-800">

                    {{-- Name --}}
                    <div class="flex items-center justify-between gap-4 py-3">

                        <flux:text class="text-zinc-500">
                            Name
                        </flux:text>

                        <flux:text class="text-right font-medium">
                            {{ $student->name }}
                        </flux:text>

                    </div>


                    {{-- Email --}}
                    <div class="flex items-center justify-between gap-4 py-3">

                        <flux:text class="text-zinc-500">
                            Email
                        </flux:text>

                        <flux:text class="text-right font-medium">
                            {{ $student->email }}
                        </flux:text>

                    </div>


                    {{-- Phone --}}
                    <div class="flex items-center justify-between gap-4 py-3">

                        <flux:text class="text-zinc-500">
                            Phone
                        </flux:text>

                        <flux:text class="text-right font-medium">
                            {{ $student->phone ?? 'Not provided' }}
                        </flux:text>

                    </div>


                    {{-- Status --}}
                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Status
                        </flux:text>

                        @if($student->status === 'active')

                            <flux:badge color="emerald">
                                Active
                            </flux:badge>

                        @else

                            <flux:badge color="zinc">
                                Inactive
                            </flux:badge>

                        @endif

                    </div>


                    {{-- Join Date --}}
                    <div class="flex items-center justify-between py-3">

                        <flux:text class="text-zinc-500">
                            Join date
                        </flux:text>

                        <flux:text class="font-medium">
                            {{ optional($student->join_date)->format('M d, Y') ?? '-' }}
                        </flux:text>

                    </div>

                </div>

            </flux:card>


            {{-- Parent --}}
            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                <flux:heading size="lg">
                    Parent
                </flux:heading>

                @if($student->parent)

                    <div class="mt-5 flex items-center gap-4">

                        <div class="flex size-14 shrink-0 items-center justify-center rounded-full bg-violet-50 text-lg font-semibold text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">

                            {{ collect(explode(' ', $student->parent->name))
                                ->map(fn ($part) => $part[0] ?? '')
                                ->take(2)
                                ->implode('') }}

                        </div>


                        <div class="min-w-0">

                            <flux:heading size="lg">
                                {{ $student->parent->name }}
                            </flux:heading>

                            @if($student->parent->email)

                                <flux:text class="mt-1 text-zinc-500">
                                    {{ $student->parent->email }}
                                </flux:text>

                            @endif

                        </div>

                    </div>


                    <div class="mt-6">

                        <flux:button
                            href="{{ route('admin.parents.show', $student->parent) }}"
                            variant="ghost"
                            icon="arrow-right"
                        >
                            View Parent
                        </flux:button>

                    </div>

                @else

                    <div class="mt-6 flex flex-col items-center justify-center py-8 text-center">

                        <div class="mb-3 flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-900">

                            <flux:icon
                                name="user"
                                class="size-6 text-zinc-400"
                            />

                        </div>

                        <flux:heading size="sm">
                            No parent assigned
                        </flux:heading>

                        <flux:text class="mt-1 text-zinc-500">
                            This student currently has no parent assigned.
                        </flux:text>

                    </div>

                @endif

            </flux:card>

        </div>


        {{-- Teachers --}}
        <flux:card class="overflow-hidden p-0 dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <flux:heading size="lg">
                            Teachers
                        </flux:heading>

                        <flux:text class="mt-1 text-zinc-500">
                            Teachers currently assigned to this student.
                        </flux:text>

                    </div>

                    <flux:badge color="zinc">
                        {{ $student->teachers->count() }}
                        {{ Str::plural('teacher', $student->teachers->count()) }}
                    </flux:badge>

                </div>

            </div>


            @if($student->teachers->count())

                <div class="divide-y divide-zinc-200 dark:divide-zinc-800">

                    @foreach($student->teachers as $teacher)

                        <div class="flex items-center justify-between gap-4 px-6 py-4 transition-colors hover:bg-zinc-50 dark:hover:bg-zinc-900">

                            <div class="flex min-w-0 items-center gap-3">

                                {{-- Avatar --}}
                                <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">

                                    {{ collect(explode(' ', $teacher->name))
                                        ->map(fn ($part) => $part[0] ?? '')
                                        ->take(2)
                                        ->implode('') }}

                                </div>


                                <div class="min-w-0">

                                    <flux:text class="truncate font-medium">
                                        {{ $teacher->name }}
                                    </flux:text>

                                    @if($teacher->email)

                                        <flux:text class="truncate text-sm text-zinc-500">
                                            {{ $teacher->email }}
                                        </flux:text>

                                    @endif

                                </div>

                            </div>


                            <flux:button
                                href="{{ route('admin.teachers.show', $teacher) }}"
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
                        No teachers assigned
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        This student currently has no teachers assigned.
                    </flux:text>

                    <flux:button
                        href="{{ route('admin.students.edit', $student) }}"
                        variant="ghost"
                        class="mt-4"
                        icon="pencil"
                    >
                        Assign Teachers
                    </flux:button>

                </div>

            @endif

        </flux:card>


        {{-- Notes --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <flux:heading size="lg">
                Notes
            </flux:heading>

            @if($student->notes)

                <flux:text class="mt-4 whitespace-pre-line text-zinc-600 dark:text-zinc-400">
                    {{ $student->notes }}
                </flux:text>

            @else

                <div class="mt-5 flex items-center gap-3 text-zinc-500">

                    <flux:icon
                        name="document-text"
                        class="size-5"
                    />

                    <flux:text>
                        No notes available.
                    </flux:text>

                </div>

            @endif

        </flux:card>

    </div>

</x-layouts::app>
