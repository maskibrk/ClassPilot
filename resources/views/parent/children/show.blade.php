<x-layouts::app :title="$child->name">

    <div class="flex flex-col gap-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                {{ $child->name }}
            </h1>

            <p class="mt-1 text-zinc-500 dark:text-zinc-400">
                Student Information
            </p>
        </div>


        {{-- Personal Information --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm
                   dark:border-zinc-800 dark:bg-zinc-900"
        >

            <h2 class="mb-4 text-xl font-semibold text-zinc-900 dark:text-white">
                Personal Information
            </h2>

            <div class="grid gap-4 md:grid-cols-2">

                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        Name
                    </p>

                    <p class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $child->name }}
                    </p>
                </div>


                @if($child->email)

                    <div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            Email
                        </p>

                        <p class="font-medium text-zinc-900 dark:text-zinc-100">
                            {{ $child->email }}
                        </p>
                    </div>

                @endif


                @if($child->phone)

                    <div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            Phone
                        </p>

                        <p class="font-medium text-zinc-900 dark:text-zinc-100">
                            {{ $child->phone }}
                        </p>
                    </div>

                @endif


                @if($child->date_of_birth)

                    <div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            Date of Birth
                        </p>

                        <p class="font-medium text-zinc-900 dark:text-zinc-100">
                            {{ $child->date_of_birth->format('M d, Y') }}
                        </p>
                    </div>

                @endif

            </div>

        </div>


        {{-- Classes --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm
                   dark:border-zinc-800 dark:bg-zinc-900"
        >

            <h2 class="mb-4 text-xl font-semibold text-zinc-900 dark:text-white">
                Classes
            </h2>

            @forelse($child->classes as $class)

                <div
                    class="border-b border-zinc-200 py-3 last:border-0
                           dark:border-zinc-700"
                >

                    <p class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $class->name }}
                    </p>

                    @if($class->teacher)
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            Taught by
                            <span class="text-zinc-700 dark:text-zinc-300">
                                {{ $class->teacher->name }}
                            </span>
                        </p>
                    @endif

                </div>

            @empty

                <p class="text-zinc-500 dark:text-zinc-400">
                    No classes assigned.
                </p>

            @endforelse

        </div>
{{-- Homework Submissions --}}
<div
    class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm
           dark:border-zinc-800 dark:bg-zinc-900"
>

    <div class="mb-4">
        <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">
            Homework & Grades
        </h2>

        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
            View your child's homework submissions and teacher grades.
        </p>
    </div>

    @forelse($child->submissions as $submission)

        <div
            class="border-b border-zinc-200 py-4 last:border-0
                   dark:border-zinc-700"
        >

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                {{-- Homework --}}
                <div>

                    <h3 class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $submission->homework->title }}
                    </h3>

                    @if($submission->homework->academyClass)

                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            Class:
                            {{ $submission->homework->academyClass->name }}
                        </p>

                    @endif

                    @if($submission->submitted_at)

                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            Submitted:
                            {{ $submission->submitted_at->format('d M Y, H:i') }}
                        </p>

                    @else

                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            Not submitted
                        </p>

                    @endif

                </div>


                {{-- Grade --}}
                <div>

                    @if($submission->grade !== null)

                        <div
                            class="inline-flex items-center rounded-lg bg-green-100 px-4 py-2
                                   font-semibold text-green-700
                                   dark:bg-green-900/30 dark:text-green-400"
                        >
                            Grade:
                            <span class="ml-1">
                                {{ $submission->grade }}
                            </span>
                        </div>

                    @else

                        <div
                            class="inline-flex items-center rounded-lg bg-zinc-100 px-4 py-2
                                   text-sm font-medium text-zinc-600
                                   dark:bg-zinc-800 dark:text-zinc-400"
                        >
                            Not graded
                        </div>

                    @endif

                </div>

            </div>

        </div>

    @empty

        <div class="py-6 text-center text-zinc-500 dark:text-zinc-400">
            No homework submissions found.
        </div>

    @endforelse

</div>

        {{-- Teachers --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm
                   dark:border-zinc-800 dark:bg-zinc-900"
        >

            <h2 class="mb-4 text-xl font-semibold text-zinc-900 dark:text-white">
                Teachers
            </h2>

            @forelse($child->teachers as $teacher)

                <div
                    class="border-b border-zinc-200 py-3 last:border-0
                           dark:border-zinc-700"
                >

                    <p class="font-medium text-zinc-900 dark:text-zinc-100">
                        {{ $teacher->name }}
                    </p>

                </div>

            @empty

                <p class="text-zinc-500 dark:text-zinc-400">
                    No teachers assigned.
                </p>

            @endforelse

        </div>


        {{-- Back button --}}
        <div>

            <a
                href="{{ route('parent.children.index') }}"
                class="inline-flex rounded-lg bg-zinc-700 px-5 py-2
                       font-medium text-white transition
                       hover:bg-zinc-800
                       dark:bg-zinc-600 dark:hover:bg-zinc-500"
            >
                ← Back to Children
            </a>

        </div>

    </div>

</x-layouts::app>
