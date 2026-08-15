
<x-layouts::app :title="__('Edit Submission')">

<div class="max-w-3xl space-y-6">

<div>

    <h1 class="text-3xl font-bold">
        Edit Submission
    </h1>

    <p class="mt-2 text-zinc-500">
        {{ $submission->homework->title }}
    </p>

</div>


@if($submission->grade !== null)

    <div class="rounded-xl border border-green-200 bg-green-50 p-5 dark:border-green-900 dark:bg-green-950">

        <h2 class="font-semibold text-green-700 dark:text-green-400">
            Submission Graded
        </h2>

        <p class="mt-1 text-sm text-green-600 dark:text-green-500">
            Your teacher has graded this submission, so it can no longer be modified or deleted.
        </p>

        <div class="mt-3 font-semibold text-green-700 dark:text-green-400">
            Grade: {{ $submission->grade }}/20
        </div>

        @if($submission->feedback)

            <div class="mt-4">

                <p class="font-medium text-green-700 dark:text-green-400">
                    Teacher Feedback
                </p>

                <p class="mt-1 whitespace-pre-line text-green-600 dark:text-green-500">
                    {{ $submission->feedback }}
                </p>

            </div>

        @endif

    </div>

@else

    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('student.submissions.update', $submission) }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf
        @method('PUT')

        @include('student.submissions._form')

        <div class="flex justify-end">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                Save Changes

            </button>

        </div>

    </form>


    <div class="rounded-xl border border-red-200 bg-white p-6 shadow dark:border-red-900 dark:bg-zinc-900">

        <h2 class="text-lg font-semibold text-red-600">
            Delete Submission
        </h2>

        <p class="mt-2 text-sm text-zinc-500">
            Deleting this submission will permanently remove your uploaded file.
            You can submit a new file later if the homework is still accepting submissions.
        </p>


<x-confirm-delete
    name="{{ $submission->homework->title }}'s submission "
    action="{{ route('student.submissions.destroy', $submission) }}"
    modal="delete-submission-{{ $submission->id }}"
/>


    </div>

@endif

</div>

</x-layouts::app>
