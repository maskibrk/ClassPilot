<x-layouts::app :title="__('Submit Homework')">

<div class="max-w-3xl space-y-6">

    <h1 class="text-3xl font-bold">
        Submit Homework
    </h1>

    <form
        method="POST"
        enctype="multipart/form-data"
        action="{{ route('student.submissions.store', $homework) }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf

        @include('student.submissions._form')

        <div class="flex justify-end">

            <button
                class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

                Submit Homework

            </button>

        </div>

    </form>

</div>

</x-layouts::app>
