
<x-layouts::app :title="$homework->title . ' - Submissions'">

<div class="space-y-6">

```
{{-- Header --}}
<div class="flex items-center justify-between">

    <div>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
            {{ $homework->title }}
        </h1>

        <p class="mt-2 text-zinc-500">
            {{ $homework->academyClass->name }}
        </p>
    </div>

    <a
        href="{{ route('teacher.homeworks.show', $homework) }}"
        class="rounded-lg bg-zinc-600 px-5 py-2 text-white hover:bg-zinc-700">
        Back to Homework
    </a>

</div>


{{-- Homework information --}}
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    <div class="grid gap-4 md:grid-cols-3">

        <div>
            <p class="text-sm text-zinc-500">
                Class
            </p>

            <p class="font-medium">
                {{ $homework->academyClass->name }}
            </p>
        </div>

        <div>
            <p class="text-sm text-zinc-500">
                Due Date
            </p>

            <p class="font-medium">
                {{ $homework->due_date?->format('d M Y') ?? 'No due date' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-zinc-500">
                Submissions
            </p>

            <p class="font-medium">
                {{ $submissions->count() }}
            </p>
        </div>

    </div>

</div>


{{-- Submissions --}}
<div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

    <div class="border-b border-zinc-200 p-6 dark:border-zinc-700">

        <h2 class="text-xl font-semibold">
            Student Submissions
        </h2>

    </div>


    @if($submissions->isEmpty())

        <div class="p-10 text-center text-zinc-500">

            No students have submitted this homework yet.

        </div>

    @else

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-zinc-50 dark:bg-zinc-800">

                    <tr>

                        <th class="px-6 py-4 font-semibold">
                            Student
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Submitted
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            File
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Grade
                        </th>

                        <th class="px-6 py-4">
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($submissions as $submission)

                        <tr class="border-t border-zinc-200 dark:border-zinc-700">

                            <td class="px-6 py-4">

                                <div class="font-medium">
                                    {{ $submission->student->name }}
                                </div>

                                @if($submission->student->email)
                                    <div class="text-sm text-zinc-500">
                                        {{ $submission->student->email }}
                                    </div>
                                @endif

                            </td>


                            <td class="px-6 py-4">

                                @if($submission->submitted_at)

                                    <div>
                                        {{ $submission->submitted_at->format('d M Y') }}
                                    </div>

                                    <div class="text-sm text-zinc-500">
                                        {{ $submission->submitted_at->format('H:i') }}
                                    </div>

                                @else

                                    <span class="text-zinc-500">
                                        Not submitted
                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                @if($submission->file_path)

                                    @php
                                        $extension = strtolower(
                                            pathinfo(
                                                $submission->file_path,
                                                PATHINFO_EXTENSION
                                            )
                                        );
                                    @endphp

                                    <span class="rounded-md bg-zinc-100 px-2 py-1 text-sm dark:bg-zinc-800">
                                        {{ strtoupper($extension) }}
                                    </span>

                                @else

                                    <span class="text-zinc-500">
                                        No file
                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4">

                                @if($submission->grade !== null)

                                    <span class="font-semibold">
                                        {{ $submission->grade }}
                                    </span>

                                @else

                                    <span class="text-zinc-500">
                                        Not graded
                                    </span>

                                @endif

                            </td>


                            <td class="px-6 py-4 text-right">

                                <a
                                    href="{{ route('teacher.homeworks.submissions.show', [$homework, $submission]) }}"
                                    class="rounded-lg bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">

                                    View

                                </a>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>
```

</div>

</x-layouts::app>
