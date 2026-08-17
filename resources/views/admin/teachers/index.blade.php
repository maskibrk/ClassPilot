<x-layouts::app :title="__('Teachers')">

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        <div class="space-y-1">

            <flux:heading size="xl">
                Teachers
            </flux:heading>

            <flux:text class="text-zinc-500">
                Manage teachers and their students.
            </flux:text>

        </div>

        <flux:button
            href="{{ route('admin.teachers.create') }}"
            variant="primary"
            icon="plus"
        >
            Add Teacher
        </flux:button>

    </div>



    {{-- Teachers --}}
    <div>
        <livewire:admin.teachers.search />
    </div>

</div>

</x-layouts::app>
