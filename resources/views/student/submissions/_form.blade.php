<div>

    <label class="block font-medium">
        Homework
    </label>

    <input
        value="{{ $homework->title}}"
        class="mt-1 w-full rounded-lg border bg-zinc-100 p-2"
        readonly>

</div>

<div>

    <label class="block font-medium">
        Upload Submission
    </label>

    @if(isset($submission) && $submission->file_path)

        <p class="mb-2 text-sm text-zinc-500">
            Current submission:
        </p>

        <a
            href="{{ route('student.submissions.show', $submission) }}"
            class="text-blue-600 hover:underline">

            View Current File

        </a>

    @endif

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
