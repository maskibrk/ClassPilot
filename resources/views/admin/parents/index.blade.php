<x-layouts::app :title="__('Parents')">
<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

        <div class="space-y-1">

            <flux:heading size="xl">
                Parents
            </flux:heading>

            <flux:text class="text-zinc-500">
                Manage parent accounts and their children.
            </flux:text>

        </div>


        <flux:button
            href="{{ route('admin.parents.create') }}"
            variant="primary"
            icon="plus"
        >
            Add Parent
        </flux:button>

    </div>


    {{-- Parents table --}}
    <div>
        <livewire:admin.parents.search />
    </div>

</div>

</x-layouts::app>
