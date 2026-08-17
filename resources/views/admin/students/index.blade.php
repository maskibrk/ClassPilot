<x-layouts::app :title="__('Students')">

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div class="space-y-1">

                <flux:heading size="xl">
                    Students
                </flux:heading>

                <flux:text class="text-zinc-500">
                    Manage students, teachers, and parent assignments.
                </flux:text>

            </div>

            <flux:button
                href="{{ route('admin.students.create') }}"
                variant="primary"
                icon="plus"
            >
                Add Student
            </flux:button>

        </div>




        {{-- Livewire --}}
        <livewire:admin.students.search />

    </div>

</x-layouts::app>
