<x-layouts::app :title="__('Create Parent')">

    <div class="max-w-3xl space-y-6">

        {{-- Header --}}
        <div class="space-y-1">
            <flux:heading size="xl">
                Create Parent
            </flux:heading>

            <flux:text class="text-zinc-500">
                Add a new parent account.
            </flux:text>
        </div>


        <form
            method="POST"
            action="{{ route('admin.parents.store') }}"
            class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900"
        >

            @csrf

            @include('admin.parents._form')

        </form>

    </div>

</x-layouts::app>
