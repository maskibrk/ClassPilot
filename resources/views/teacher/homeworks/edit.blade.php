<x-layouts::app :title="__('Edit Homework')">

<div class="max-w-3xl space-y-6">

    <h1 class="text-3xl font-bold">

        Edit Homework

    </h1>

    <form
        method="POST"
        action="{{ route('teacher.homeworks.update', $homework) }}"
enctype="multipart/form-data"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf
        @method('PUT')

        @include('teacher.homeworks._form')

        <div class="flex justify-end">

            <button
                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                Save Changes

            </button>

        </div>

    </form>

<x-confirm-delete
    name="{{ $homework->title }}"
    action="{{ route('teacher.homeworks.destroy', $homework) }}"
    modal="delete-homework-{{ $homework->id }}"
/>


</div>

</x-layouts::app>
