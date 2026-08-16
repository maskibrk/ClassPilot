<x-layouts::app :title="__('Edit Class')">

<div class="max-w-3xl space-y-6">
    {{-- Header --}}
        <div class="space-y-1">
            <flux:heading size="xl">
                Edit Class
            </flux:heading>

            <flux:text class="text-zinc-500">
                Update the class information, teacher, capacity, and students.
            </flux:text>
        </div>
    <form
        method="POST"
        action="{{ route('admin.classes.update', $class) }}"
        class="space-y-5 rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        @csrf
        @method('PUT')

        @include('admin.classes._form')

    </form>


<x-confirm-delete
    name="{{ $class->name }}"
    action="{{ route('admin.classes.destroy', $class) }}"
modal="delete-class-{{ $class->id }}"
/>


</div>

</x-layouts::app>
