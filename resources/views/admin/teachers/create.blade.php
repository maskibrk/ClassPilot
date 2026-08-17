<x-layouts::app :title="__('Create Teacher')">

<div class="space-y-8">

    {{-- Header --}}
    <div class="space-y-2">

        <div>
            <flux:button
                href="{{ route('admin.teachers.index') }}"
                variant="ghost"
                size="sm"
                icon="arrow-left"
                inset
            >
                Teachers
            </flux:button>
        </div>

        <flux:heading size="xl">
            Create Teacher
        </flux:heading>

        <flux:text class="text-zinc-500">
            Create a new teacher account.
        </flux:text>

    </div>


    {{-- Form --}}
    <div class="max-w-3xl">

        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            @include('admin.teachers._form', [
                'action' => route('admin.teachers.store'),
                'method' => 'POST',
                'submitLabel' => 'Create Teacher',
                'teacher' => null,
            ])

        </flux:card>

    </div>

</div>

</x-layouts::app>
