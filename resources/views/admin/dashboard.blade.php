<x-layouts::app :title="__('Dashboard')">

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div class="space-y-2">

                <flux:heading size="xl">
                    Dashboard
                </flux:heading>

                <flux:text class="text-zinc-500">
                    Overview of your academy and what's happening today.
                </flux:text>

            </div>

            <div class="flex flex-wrap gap-2">

                <flux:button
                    href="{{ route('admin.students.create') }}"
                    variant="primary"
                    icon="plus"
                >
                    Add Student
                </flux:button>

                <flux:button
                    href="{{ route('admin.classes.create') }}"
                    variant="ghost"
                    icon="academic-cap"
                >
                    Add Class
                </flux:button>

            </div>

        </div>


        {{-- Main Statistics --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            {{-- Students --}}
            <flux:card class="relative overflow-hidden p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex items-start justify-between">

                    <div>

                        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500">
                            Students
                        </flux:text>

                        <flux:heading size="xl" class="mt-2">
                            {{ $totalStudents ?? '—' }}
                        </flux:heading>

                        @if(isset($newStudentsThisMonth))
                            <flux:text class="mt-2 text-sm text-zinc-500">
                                <span class="font-medium text-emerald-600 dark:text-emerald-400">
                                    +{{ $newStudentsThisMonth }}
                                </span>
                                this month
                            </flux:text>
                        @endif

                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                        <flux:icon name="academic-cap" class="size-5" />
                    </div>

                </div>

            </flux:card>


            {{-- Teachers --}}
            <flux:card class="relative overflow-hidden p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex items-start justify-between">

                    <div>

                        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500">
                            Teachers
                        </flux:text>

                        <flux:heading size="xl" class="mt-2">
                            {{ $totalTeachers ?? '—' }}
                        </flux:heading>

                        <flux:text class="mt-2 text-sm text-zinc-500">
                            Active teaching staff
                        </flux:text>

                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                        <flux:icon name="user-group" class="size-5" />
                    </div>

                </div>

            </flux:card>


            {{-- Parents --}}
            <flux:card class="relative overflow-hidden p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex items-start justify-between">

                    <div>

                        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500">
                            Parents
                        </flux:text>

                        <flux:heading size="xl" class="mt-2">
                            {{ $totalParents ?? '—' }}
                        </flux:heading>

                        <flux:text class="mt-2 text-sm text-zinc-500">
                            Registered accounts
                        </flux:text>

                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                        <flux:icon name="users" class="size-5" />
                    </div>

                </div>

            </flux:card>


            {{-- Classes --}}
            <flux:card class="relative overflow-hidden p-5 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex items-start justify-between">

                    <div>

                        <flux:text class="text-xs font-medium uppercase tracking-wide text-zinc-500">
                            Classes
                        </flux:text>

                        <flux:heading size="xl" class="mt-2">
                            {{ $totalClasses ?? '—' }}
                        </flux:heading>

                        @if(isset($fullClasses))
                            <flux:text class="mt-2 text-sm text-zinc-500">

                                @if($fullClasses > 0)

                                    <span class="font-medium text-amber-600 dark:text-amber-400">
                                        {{ $fullClasses }}
                                    </span>
                                    full

                                @else

                                    All classes have availability

                                @endif

                            </flux:text>
                        @endif

                    </div>

                    <div class="flex size-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                        <flux:icon name="building-office-2" class="size-5" />
                    </div>

                </div>

            </flux:card>

        </div>

{{-- Enrollment Overview --}}
<flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <flux:heading size="lg">
                Enrollment Overview
            </flux:heading>

            <flux:text class="mt-1 text-zinc-500">
                Current enrollment capacity across all classes.
            </flux:text>
        </div>

        @if($totalCapacity > 0)

            @php
                $enrollmentPercentage = round(
                    ($totalEnrolled / $totalCapacity) * 100
                );

                $statusColor = match (true) {
                    $enrollmentPercentage >= 90 => 'red',
                    $enrollmentPercentage >= 75 => 'amber',
                    default => 'emerald',
                };

                $barColor = match (true) {
                    $enrollmentPercentage >= 90 => 'bg-red-500',
                    $enrollmentPercentage >= 75 => 'bg-amber-500',
                    default => 'bg-emerald-500',
                };
            @endphp

            <flux:badge color="{{ $statusColor }}">
                {{ $enrollmentPercentage }}% occupied
            </flux:badge>

        @endif

    </div>


    @if($totalCapacity > 0)

        {{-- Numbers --}}
        <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">

            <div class="rounded-xl bg-zinc-50 p-4 dark:bg-zinc-900">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Enrollments
                </flux:text>

                <flux:heading size="lg" class="mt-1">
                    {{ $totalEnrolled }}
                </flux:heading>

            </div>


            <div class="rounded-xl bg-zinc-50 p-4 dark:bg-zinc-900">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Total Capacity
                </flux:text>

                <flux:heading size="lg" class="mt-1">
                    {{ $totalCapacity }}
                </flux:heading>

            </div>


            <div class="rounded-xl bg-zinc-50 p-4 dark:bg-zinc-900">

                <flux:text class="text-xs uppercase tracking-wide text-zinc-500">
                    Available Seats
                </flux:text>

                <flux:heading size="lg" class="mt-1">
                    {{ max(0, $totalCapacity - $totalEnrolled) }}
                </flux:heading>

            </div>

        </div>


        {{-- Progress --}}
        <div class="mt-6">

            <div class="mb-2 flex items-center justify-between">

                <flux:text class="text-sm text-zinc-500">
                    Capacity usage
                </flux:text>

                <flux:text class="text-sm font-medium">
                    {{ $totalEnrolled }} / {{ $totalCapacity }}
                </flux:text>

            </div>


            <div class="h-3 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">

                <div
                    class="h-full rounded-full transition-all {{ $barColor }}"
                    style="width: {{ min($enrollmentPercentage, 100) }}%"
                ></div>

            </div>

        </div>

    @else

        <div class="mt-6 rounded-xl bg-zinc-50 p-6 text-center dark:bg-zinc-900">

            <flux:text class="text-zinc-500">
                No class capacity available yet.
            </flux:text>

        </div>

    @endif

</flux:card>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


            {{-- Recent Students --}}
            <flux:card class="overflow-hidden p-0 xl:col-span-2 dark:!bg-zinc-950 dark:border-zinc-800">

                <div class="flex items-center justify-between border-b border-zinc-200 px-6 py-5 dark:border-zinc-800">

                    <div>

                        <flux:heading size="lg">
                            Recent Students
                        </flux:heading>

                        <flux:text class="mt-1 text-zinc-500">
                            Recently added students.
                        </flux:text>

                    </div>

                    <flux:button
                        href="{{ route('admin.students.index') }}"
                        variant="ghost"
                        size="sm"
                        icon="arrow-right"
                        inset
                    >
                        View all
                    </flux:button>

                </div>


                @if(isset($recentStudents) && $recentStudents->count())

                    <div class="divide-y divide-zinc-200 dark:divide-zinc-800">

                        @foreach($recentStudents as $student)

                            <div class="flex items-center justify-between gap-4 px-6 py-4">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex size-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">

                                        {{ collect(explode(' ', $student->name))
                                            ->map(fn ($part) => $part[0] ?? '')
                                            ->take(2)
                                            ->implode('') }}

                                    </div>

                                    <div class="min-w-0">

                                        <flux:text class="truncate font-medium">
                                            {{ $student->name }}
                                        </flux:text>

                                        <flux:text class="truncate text-sm text-zinc-500">
                                            {{ $student->email }}
                                        </flux:text>

                                    </div>

                                </div>


                                <div class="flex items-center gap-3">

                                    @if($student->status === 'active')

                                        <flux:badge color="emerald">
                                            Active
                                        </flux:badge>

                                    @else

                                        <flux:badge color="zinc">
                                            Inactive
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

                        <flux:icon
                            name="academic-cap"
                            class="size-8 text-zinc-400"
                        />

                        <flux:heading size="sm" class="mt-3">
                            No students yet
                        </flux:heading>

                        <flux:text class="mt-1 text-zinc-500">
                            Add your first student to get started.
                        </flux:text>

                    </div>

                @endif

            </flux:card>


            {{-- Alerts --}}
            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                <flux:heading size="lg">
                    Attention
                </flux:heading>

                <flux:text class="mt-1 text-zinc-500">
                    Things that may need your attention.
                </flux:text>


                <div class="mt-5 space-y-3">

                    {{-- Full classes --}}
                    @if(($fullClasses ?? 0) > 0)

                        <a
                            href="{{ route('admin.classes.index',['status'=>'full'] )}}"

                            class="flex items-start gap-3 rounded-xl bg-amber-50 p-4 transition hover:bg-amber-100 dark:bg-amber-500/10 dark:hover:bg-amber-500/15"
                        >

                            <flux:icon
                                name="exclamation-triangle"
                                class="mt-0.5 size-5 shrink-0 text-amber-600 dark:text-amber-400"
                            />

                            <div>

                                <flux:text class="font-medium">
                                    Full classes
                                </flux:text>

                                <flux:text class="mt-1 text-sm text-zinc-500">
                                    {{ $fullClasses }} {{ Str::plural('class', $fullClasses) }}
                                    {{ $fullClasses === 1 ? 'is' : 'are' }} currently full.
                                </flux:text>

                            </div>

                        </a>

                    @endif


                    {{-- Students without parent --}}
                    @if(isset($studentsWithoutParent) && $studentsWithoutParent > 0)

                        <a
                            href="{{ route('admin.students.index',['status'=>'no_parent'] ) }}"
                            class="flex items-start gap-3 rounded-xl bg-violet-50 p-4 transition hover:bg-violet-100 dark:bg-violet-500/10 dark:hover:bg-violet-500/15"
                        >

                            <flux:icon
                                name="user"
                                class="mt-0.5 size-5 shrink-0 text-violet-600 dark:text-violet-400"
                            />

                            <div>

                                <flux:text class="font-medium">
                                    Students without parents
                                </flux:text>

                                <flux:text class="mt-1 text-sm text-zinc-500">
                                    {{ $studentsWithoutParent }}
                                    {{ Str::plural('student', $studentsWithoutParent) }}
                                    {{ $studentsWithoutParent === 1 ? 'has' : 'have' }}
                                    no parent assigned.
                                </flux:text>

                            </div>

                        </a>

                    @endif


                    {{-- Students without teachers --}}
                    @if(isset($studentsWithoutTeachers) && $studentsWithoutTeachers > 0)

                        <a
                            href="{{ route('admin.students.index',['status'=>'no_teachers'] ) }}"
                            class="flex items-start gap-3 rounded-xl bg-red-50 p-4 transition hover:bg-red-100 dark:bg-red-500/10 dark:hover:bg-red-500/15"
                        >

                            <flux:icon
                                name="academic-cap"
                                class="mt-0.5 size-5 shrink-0 text-red-600 dark:text-red-400"
                            />

                            <div>

                                <flux:text class="font-medium">
                                    Students without teachers
                                </flux:text>

                                <flux:text class="mt-1 text-sm text-zinc-500">
                                    {{ $studentsWithoutTeachers }}
                                    {{ Str::plural('student', $studentsWithoutTeachers) }}
                                    need teacher assignment.
                                </flux:text>

                            </div>

                        </a>

                    @endif


                    @if(
                        ($fullClasses ?? 0) === 0 &&
                        ($studentsWithoutParent ?? 0) === 0 &&
                        ($studentsWithoutTeachers ?? 0) === 0
                    )

                        <div class="flex flex-col items-center justify-center rounded-xl bg-emerald-50 px-4 py-8 text-center dark:bg-emerald-500/10">

                            <flux:icon
                                name="check-circle"
                                class="size-7 text-emerald-600 dark:text-emerald-400"
                            />

                            <flux:heading size="sm" class="mt-3">
                                Everything looks good
                            </flux:heading>

                            <flux:text class="mt-1 text-sm text-zinc-500">
                                There are no issues requiring attention.
                            </flux:text>

                        </div>

                    @endif

                </div>

            </flux:card>

        </div>


        {{-- Quick Actions --}}
        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            <div class="mb-5">

                <flux:heading size="lg">
                    Quick Actions
                </flux:heading>

                <flux:text class="mt-1 text-zinc-500">
                    Common administrative tasks.
                </flux:text>

            </div>


            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                <flux:button
                    href="{{ route('admin.students.create') }}"
                    variant="ghost"
                    icon="user-plus"
                    class="justify-start"
                >
                    Add Student
                </flux:button>

                <flux:button
                    href="{{ route('admin.teachers.create') }}"
                    variant="ghost"
                    icon="academic-cap"
                    class="justify-start"
                >
                    Add Teacher
                </flux:button>

                <flux:button
                    href="{{ route('admin.parents.create') }}"
                    variant="ghost"
                    icon="user"
                    class="justify-start"
                >
                    Add Parent
                </flux:button>

                <flux:button
                    href="{{ route('admin.classes.create') }}"
                    variant="ghost"
                    icon="building-office-2"
                    class="justify-start"
                >
                    Add Class
                </flux:button>

            </div>

        </flux:card>

    </div>

</x-layouts::app>
