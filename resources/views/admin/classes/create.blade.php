<x-layouts::app :title="__('Create Class')">

<div class="max-w-3xl space-y-6">

    <h1 class="text-3xl font-bold">
        Create Class
    </h1>

    <form
        method="POST"
        action="{{ route('admin.classes.store') }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf

        @include('admin.classes._form')

        <div class="flex justify-end">

            <button
                type="submit"
                class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

                Create Class

            </button>

        </div>

    </form>

</div>

</x-layouts::app>
