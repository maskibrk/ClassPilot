<x-layouts::app :title="__('Edit Class')">
<div class="max-w-3xl space-y-6">
    <h1 class="text-3xl font-bold">Edit Class</h1>

    <form
        method="POST"
        action="{{ route('teacher.classes.update', $class) }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">
        @csrf
        @method('PUT')
        @include('teacher.classes._form')
        <div class="flex justify-end">
            <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">
                Save Changes
            </button>
        </div>
    </form>

    <form
        action="{{ route('teacher.classes.destroy', $class) }}"
        method="POST"
        onsubmit="return confirm('Are you sure you want to delete this class?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-lg bg-red-600 px-5 py-2 text-white hover:bg-red-700">
            Delete Class
        </button>
    </form>
</div>

</x-layouts::app>
