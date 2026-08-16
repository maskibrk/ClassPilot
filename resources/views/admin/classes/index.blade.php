<x-layouts::app :title="__('Classes')">
    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="space-y-1">
                <flux:heading size="xl">
                    Classes
                </flux:heading>
                <flux:text class="text-zinc-500">
                    Manage your academy classes and their students.
                </flux:text>
            </div>

            <flux:button
                href="{{ route('admin.classes.create') }}"
                variant="primary"
                icon="plus"
            >
                Add Class
            </flux:button>
        </div>


        {{-- Classes table --}}
        <div>
            <livewire:admin.academy-class.search />
        </div>

    </div>
</x-layouts::app>
