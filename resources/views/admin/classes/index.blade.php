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

        {{-- Success message --}}
        @if (session('success'))
            <flux:callout
                variant="success"
                icon="check-circle"
            >
                {{ session('success') }}
            </flux:callout>
        @endif

        {{-- Quick stats --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                    <flux:icon name="academic-cap" class="size-5" />
                </div>
                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">Total Classes</flux:text>
                    <flux:heading size="lg">{{ $totalClasses ?? '—' }}</flux:heading>
                </div>
            </flux:card>

            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    <flux:icon name="users" class="size-5" />
                </div>
                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">Enrolled Students</flux:text>
                    <flux:heading size="lg">{{ $totalStudents ?? '—' }}</flux:heading>
                </div>
            </flux:card>

            <flux:card class="flex items-center gap-4 p-5 dark:!bg-zinc-950 dark:border-zinc-800">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    <flux:icon name="exclamation-triangle" class="size-5" />
                </div>
                <div>
                    <flux:text class="text-xs uppercase tracking-wide text-zinc-500">Full Classes</flux:text>
                    <flux:heading size="lg">{{ $fullClasses ?? '—' }}</flux:heading>
                </div>
            </flux:card>

        </div>

        {{-- Classes table --}}
        <div>
            <livewire:admin.academy-class.search />
        </div>

    </div>
</x-layouts::app>
