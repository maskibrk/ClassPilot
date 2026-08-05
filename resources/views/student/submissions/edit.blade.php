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

</div>

</x-layouts::app>
