
<x-layouts::app :title="'Grade Submission'">

<div class="max-w-4xl space-y-6">

```
{{-- Header --}}
<div class="flex items-center justify-between">

    <div>

        <h1 class="text-3xl font-bold">
            Grade Submission
        </h1>

        <p class="mt-2 text-zinc-500">
            {{ $submission->student->name }}
            ·
            {{ $homework->title }}
        </p>

    </div>

    <a
        href="{{ route('teacher.homeworks.submissions.show', [$homework, $submission]) }}"
        class="rounded-lg bg-zinc-600 px-5 py-2 text-white hover:bg-zinc-700">

        Back

    </a>

</div>


{{-- Student Information --}}
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    <h2 class="text-lg font-semibold">
        Student
    </h2>

    <div class="mt-4 grid gap-4 md:grid-cols-2">

        <div>

            <p class="text-sm text-zinc-500">
                Name
            </p>

            <p class="font-medium">
                {{ $submission->student->name }}
            </p>

        </div>

        @if($submission->student->email)

            <div>

                <p class="text-sm text-zinc-500">
                    Email
                </p>

                <p class="font-medium">
                    {{ $submission->student->email }}
                </p>

            </div>

        @endif

        <div>

            <p class="text-sm text-zinc-500">
                Homework
            </p>

            <p class="font-medium">
                {{ $homework->title }}
            </p>

        </div>

        <div>

            <p class="text-sm text-zinc-500">
                Submitted
            </p>

            <p class="font-medium">
                {{ $submission->submitted_at?->format('d M Y \a\t H:i') ?? 'Not submitted' }}
            </p>

        </div>

    </div>

</div>


{{-- Submission File --}}
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    <h2 class="text-lg font-semibold">
        Student Submission
    </h2>

    @if($submission->file_path)

        @php
            $extension = strtolower(
                pathinfo($submission->file_path, PATHINFO_EXTENSION)
            );
        @endphp


        @if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))

            <img
                src="{{ route('teacher.submissions.preview', $submission) }}"
                alt="Student submission"
                class="mt-4 max-h-[700px] rounded-lg border">

        @elseif($extension === 'pdf')

            <iframe
                src="{{ route('teacher.submissions.preview', $submission) }}"
                class="mt-4 h-[800px] w-full rounded-lg border">
            </iframe>

        @else

            <div class="mt-4 rounded-lg border bg-zinc-50 p-6 dark:bg-zinc-800">

                <p class="font-medium">
                    {{ basename($submission->file_path) }}
                </p>

                <p class="mt-1 text-sm text-zinc-500">
                    This file type cannot be previewed in the browser.
                </p>

                <a
                    href="{{ route('teacher.submissions.preview', $submission) }}"
                    target="_blank"
                    class="mt-4 inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                    Open Submission

                </a>

            </div>

        @endif

    @else

        <div class="mt-4 rounded-lg border border-dashed p-6 text-center text-zinc-500">

            No file was submitted.

        </div>

    @endif

</div>


{{-- Grade Form --}}
<form
    method="POST"
    action="{{ route('teacher.homeworks.submissions.update', [$homework, $submission]) }}"
    class="space-y-6 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

    @csrf
    @method('PUT')


    <div>

        <label class="block font-medium">
            Grade
        </label>

        <input
            type="number"
            name="grade"
            min="0"
            max="20"
            step="0.01"
            value="{{ old('grade', $submission->grade) }}"
            class="mt-1 w-full rounded-lg border p-2 dark:bg-zinc-800">

        @error('grade')
            <p class="mt-1 text-sm text-red-500">
                {{ $message }}
            </p>
        @enderror

    </div>


    <div>

        <label class="block font-medium">
            Feedback
        </label>

        <textarea
            name="feedback"
            rows="6"
            class="mt-1 w-full rounded-lg border p-2 dark:bg-zinc-800"
            placeholder="Write feedback for the student...">{{ old('feedback', $submission->feedback) }}</textarea>

        @error('feedback')
            <p class="mt-1 text-sm text-red-500">
                {{ $message }}
            </p>
        @enderror

    </div>


    <div class="flex justify-end">

        <button
            type="submit"
            class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

            Save Grade

        </button>

    </div>

</form>
```

</div>

</x-layouts::app>
