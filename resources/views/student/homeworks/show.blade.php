<x-layouts::app :title="$homework->title">

<div class="space-y-6">

    <!-- Header -->
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
            href="{{ route('student.homeworks.index') }}"
            class="rounded-lg bg-zinc-600 px-5 py-2 text-white hover:bg-zinc-700">
            Back
        </a>
    </div>

    <!-- Homework Info -->
    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="space-y-5">

            <div>
                <h2 class="text-lg font-semibold">Instructions</h2>

                <p class="mt-2 whitespace-pre-line">
                    {{ $homework->instructions ?: 'No instructions provided.' }}
                </p>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <strong>Class:</strong>
                    {{ $homework->academyClass->name }}
                </div>

                <div>
                    <strong>Due Date:</strong>
                    {{ $homework->due_date?->format('d M Y') ?? 'No due date' }}
                </div>

                <div>
                    <strong>Teacher:</strong>
                    {{ $homework->academyClass->teacher->name }}
                </div>

                <div>
                    <strong>Assigned:</strong>
                    {{ $homework->created_at->format('d M Y') }}
                </div>
            </div>

        </div>

    </div>

    <!-- Attachment -->
    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <h2 class="text-lg font-semibold">Attachment</h2>

        @if($homework->file_path)

            @php
                $extension = strtolower(pathinfo($homework->file_path, PATHINFO_EXTENSION));
            @endphp

            @if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))

                <img
                    src="{{ route('student.homeworks.preview', $homework) }}"
                    alt="Homework attachment"
                    class="mt-4 max-h-[700px] rounded-lg border">

            @elseif($extension === 'pdf')

                <iframe
                    src="{{ route('student.homeworks.preview', $homework) }}"
                    class="mt-4 h-[800px] w-full rounded-lg border">
                </iframe>

            @else

                <div class="mt-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-700 dark:bg-zinc-800">

                    <p class="font-medium">
                        {{ basename($homework->file_path) }}
                    </p>

                    <p class="mt-1 text-sm text-zinc-500">
                        This file type can't be previewed in the browser.
                    </p>

                    <a
                        href="{{ route('student.homeworks.preview', $homework) }}"
                        target="_blank"
                        class="mt-4 inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                        Open Attachment
                    </a>

                </div>

            @endif

        @else

            <div class="mt-4 rounded-lg border border-dashed border-zinc-300 p-6 text-center text-zinc-500 dark:border-zinc-700">
                No attachment was uploaded for this homework.
            </div>

        @endif

    </div>
<div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-lg font-semibold">
                    Your Submission
                </h2>

                @if($submission)

                    <p class="mt-2 text-green-600">

                        Submitted
                        {{ $submission->submitted_at?->format('d M Y \a\t H:i') }}

                    </p>

                @else

                    <p class="mt-2 text-red-600">

                        You haven't submitted this homework yet.

                    </p>

                @endif

            </div>

            @if($submission)

                <a
                    href="{{ route('student.submissions.edit', $submission) }}"
                    class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                    Update Submission

                </a>

            @else

                <a
                    href="{{ route('student.submissions.create', $homework) }}"
                    class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

                    Submit Homework

                </a>

            @endif

        </div>


        @if($submission && $submission->file_path)

            @php
                $extension = strtolower(pathinfo($submission->file_path, PATHINFO_EXTENSION));
            @endphp

            <div class="mt-6">

                @if(in_array($extension, ['png','jpg','jpeg','gif','webp']))

                    <img
                        src="{{ route('student.submissions.preview', $submission) }}"
                        class="max-h-[600px] rounded-lg border">

                @elseif($extension === 'pdf')

                    <iframe
                        src="{{ route('student.submissions.preview', $submission) }}"
                        class="h-[700px] w-full rounded-lg border">
                    </iframe>

                @else

                    <a
                        href="{{ route('student.submissions.preview', $submission) }}"
                        target="_blank"
                        class="inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                        Open Submitted File

                    </a>

                @endif

            </div>

        @endif

    </div>
</div>

</x-layouts::app>
