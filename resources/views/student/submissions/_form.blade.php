<div>

    <label class="block font-medium">
        Homework
    </label>

    <input
        value="{{ $homework->title ?? $submission->homework->title }}"
        class="mt-1 w-full rounded-lg border bg-zinc-100 p-2 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100"
        readonly>

</div>

<div>


    @if(isset($submission) && $submission->file_path)

        @php
            $extension = strtolower(pathinfo($submission->file_path, PATHINFO_EXTENSION));
        @endphp

        <div class="mt-3 rounded-lg border bg-zinc-50 p-4 dark:bg-zinc-800">

            <p class="mb-4 font-medium">
                Current Submission
            </p>

            @if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))

                <img
                    src="{{ route('student.submissions.preview', $submission) }}"
                    alt="Submission"
                    class="max-h-[500px] rounded-lg border">

            @elseif($extension === 'pdf')

                <iframe
                    src="{{ route('student.submissions.preview', $submission) }}"
                    class="h-[700px] w-full rounded-lg border">
                </iframe>

            @else

                <div class="rounded-lg border border-dashed border-zinc-300 p-6 text-center dark:border-zinc-700">

                    <p class="font-medium">
                        {{ basename($submission->file_path) }}
                    </p>

                    <p class="mt-2 text-sm text-zinc-500">
                        This file type cannot be previewed in the browser.
                    </p>

                    <a
                        href="{{ route('student.submissions.preview', $submission) }}"
                        target="_blank"
                        class="mt-4 inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                        Open File

                    </a>

                </div>

            @endif

        </div>

    @endif

    <label class="mt-5 block font-medium">
        {{ isset($submission) ? 'Replace Submission' : 'Upload Submission' }}
    </label>

    <input
        type="file"
        name="file"
        class="mt-2 w-full rounded-lg border p-2">

    @error('file')
        <p class="mt-1 text-sm text-red-500">
            {{ $message }}
        </p>
    @enderror

</div>
