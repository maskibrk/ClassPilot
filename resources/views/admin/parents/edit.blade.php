<x-layouts::app :title="__('Edit Parent')">

    <div class="max-w-3xl space-y-6">

        {{-- Header --}}
        <div class="space-y-1">
            <flux:heading size="xl">
                Edit Parent
            </flux:heading>

            <flux:text class="text-zinc-500">
                Update the parent's account information and children.
            </flux:text>
        </div>


        <form
            method="POST"
            action="{{ route('admin.parents.update', $parent) }}"
            class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900"
        >

            @csrf
            @method('PUT')

            @include('admin.parents._form')

        </form>


        <x-confirm-delete
            name="{{ $parent->name }}"
            action="{{ route('admin.parents.destroy', $parent) }}"
            modal="delete-parent-{{ $parent->id }}"
        />

    </div>

</x-layouts::app>
