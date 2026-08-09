
<x-layouts::app :title="$submission->student->name . ' - Submission'">

<div class="space-y-6">

```
{{-- Header --}}
<div class="flex items-center justify-between">

    <div>
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
            {{ $submission->student->name }}'s Submission
        </h1>

        <p class="mt-2 text-zinc-500">
            {{ $homework->title }}
            ·
            {{ $homework->academyClass->name }}
        </p>
    </div>

    <a
        href="{{ route('teacher.homeworks.submissions.index', $homework) }}"
        class="rounded-lg bg-zinc-600 px-5 py-2 text-white hover:bg-zinc-700">

        Back to Submissions

    </a>

</div>


{{-- Student / Homework Information --}}
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    <div class="grid gap-6 md:grid-cols-2">

        <div>
            <p class="text-sm text-zinc-500">
                Student
            </p>

            <p class="mt-1 text-lg font-semibold">
                {{ $submission->student->name }}
            </p>

            @if($submission->student->email)

                <p class="text-sm text-zinc-500">
                    {{ $submission->student->email }}
                </p>

            @endif
        </div>


        <div>
            <p class="text-sm text-zinc-500">
                Homework
            </p>

            <p class="mt-1 text-lg font-semibold">
                {{ $homework->title }}
            </p>

            <p class="text-sm text-zinc-500">
                {{ $homework->academyClass->name }}
            </p>
        </div>


        <div>
            <p class="text-sm text-zinc-500">
                Submitted At
            </p>

            @if($submission->submitted_at)

                <p class="mt-1 font-medium">
                    {{ $submission->submitted_at->format('d M Y \a\t H:i') }}
                </p>

            @else

                <p class="mt-1 text-zinc-500">
                    Not submitted
                </p>

            @endif
        </div>


        <div>
            <p class="text-sm text-zinc-500">
                Due Date
            </p>

            <p class="mt-1 font-medium">
                {{ $homework->due_date?->format('d M Y') ?? 'No due date' }}
            </p>
        </div>

    </div>

</div>


{{-- Submitted File --}}
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    <h2 class="text-xl font-semibold">
        Submitted File
    </h2>


    @if($submission->file_path)

        @php
            $extension = strtolower(
                pathinfo(
                    $submission->file_path,
                    PATHINFO_EXTENSION
                )
            );
        @endphp


        {{-- Images --}}
        @if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))

            <div class="mt-5">

                <img
                    src="{{ route('teacher.submissions.preview', $submission) }}"
                    alt="Student submission"
                    class="max-h-[700px] max-w-full rounded-lg border object-contain">

            </div>


        {{-- PDF --}}
        @elseif($extension === 'pdf')

            <iframe
                src="{{ route('teacher.submissions.preview', $submission) }}"
                class="mt-5 h-[800px] w-full rounded-lg border">
            </iframe>


        {{-- Other files --}}
        @else

            <div class="mt-5 rounded-lg border border-zinc-200 bg-zinc-50 p-6 dark:border-zinc-700 dark:bg-zinc-800">

                <p class="font-medium">
                    {{ basename($submission->file_path) }}
                </p>

                <p class="mt-1 text-sm text-zinc-500">
                    This file type cannot be previewed directly in the browser.
                </p>

                <a
                    href="{{ route('teacher.submissions.preview', $submission) }}"
                    target="_blank"
                    class="mt-4 inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                    Open File

                </a>

            </div>

        @endif

    @else

        <div class="mt-5 rounded-lg border border-dashed border-zinc-300 p-8 text-center text-zinc-500 dark:border-zinc-700">

            No file was submitted.

        </div>

    @endif

</div>


{{-- Grading --}}
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    <h2 class="text-xl font-semibold">
        Grade & Feedback
    </h2>

    <div class="mt-5 space-y-4">

        <div>

            <p class="text-sm text-zinc-500">
                Grade
            </p>

            <p class="mt-1 text-lg font-semibold">
                {{ $submission->grade ?? 'Not graded yet' }}
            </p>

        </div>


        <div>

            <p class="text-sm text-zinc-500">
                Feedback
            </p>

            <p class="mt-1 whitespace-pre-line">
                {{ $submission->feedback ?: 'No feedback provided.' }}
            </p>

        </div>

    </div>

</div>


{{-- Actions --}}
<div class="flex items-center justify-between">

    <a
        href="{{ route('teacher.homeworks.submissions.index', $homework) }}"
        class="rounded-lg bg-zinc-600 px-5 py-2 text-white hover:bg-zinc-700">

        Back

    </a>

    <a
        href="{{ route('teacher.homeworks.submissions.edit', [$homework, $submission]) }}"
        class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

        Grade Submission

    </a>

</div>
```

</div>

</x-layouts::app>
