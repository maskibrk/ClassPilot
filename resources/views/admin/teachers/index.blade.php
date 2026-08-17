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


    {{-- Success Message --}}
    @if(session('success'))

        <flux:card class="border-emerald-200 bg-emerald-50 dark:border-emerald-900 dark:bg-emerald-950/30">

            <div class="flex items-center gap-3">

                <flux:icon
                    name="check-circle"
                    class="size-5 text-emerald-600 dark:text-emerald-400"
                />

                <flux:text class="text-emerald-700 dark:text-emerald-300">
                    {{ session('success') }}
                </flux:text>

            </div>

        </flux:card>

    @endif


    {{-- Teachers --}}
    <div>
        <livewire:admin.teachers.search />
    </div>

</div>

</x-layouts::app>
