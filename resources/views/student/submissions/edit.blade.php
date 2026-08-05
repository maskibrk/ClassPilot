<x-layouts::app :title="__('Edit Submission')">

<div class="max-w-3xl space-y-6">

    <h1 class="text-3xl font-bold">
        Edit Submission
    </h1>

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
                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                Save Changes

            </button>

        </div>

    </form>
<div class="mt-8 border-t pt-6">

    <h2 class="text-lg font-semibold text-red-600">
        Delete Submission
    </h2>

    <p class="mt-2 text-sm text-zinc-500">
        Deleting this submission will permanently remove your uploaded file. You can submit a new file later if the homework is still accepting submissions.
    </p>

    <form
        method="POST"
        action="{{ route('student.submissions.destroy', $submission) }}"
        class="mt-4"
        onsubmit="return confirm('Are you sure you want to delete your submission?');">

        @csrf
        @method('DELETE')

        <button
            type="submit"
            class="rounded-lg bg-red-600 px-5 py-2 text-white hover:bg-red-700">

            Delete Submission

        </button>

    </form>

</div>

    </form>

</div>

</x-layouts::app>
