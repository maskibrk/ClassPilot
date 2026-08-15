<x-layouts::app :title="__('Edit Class')">

<div class="max-w-3xl space-y-6">

    <h1 class="text-3xl font-bold">
        Edit Class
    </h1>

    <form
        method="POST"
        action="{{ route('admin.classes.update', $class) }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf
        @method('PUT')

        @include('admin.classes._form')

        <div class="flex justify-end">

            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                Save Changes

            </button>

        </div>

    </form>


<x-confirm-delete
    name="{{ $class->name }}"
    action="{{ route('admin.classes.destroy', $class) }}"
modal="delete-class-{{ $class->id }}"
/>


</div>

</x-layouts::app>
