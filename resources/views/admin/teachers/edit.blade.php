<x-layouts::app :title="__('Edit Teacher')">

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

        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div>

                <flux:heading size="xl">
                    Edit Teacher
                </flux:heading>

                <flux:text class="mt-1 text-zinc-500">
                    Update {{ $teacher->name }}'s account and student assignments.
                </flux:text>

            </div>

            <flux:badge
                color="zinc"
                icon="user"
            >
                {{ $teacher->name }}
            </flux:badge>

        </div>

    </div>


    {{-- Form --}}
    <div class="max-w-3xl">

        <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

            @include('admin.teachers._form', [
                'action' => route('admin.teachers.update', $teacher),
                'method' => 'PUT',
                'submitLabel' => 'Save Changes',
                'teacher' => $teacher,
                'students' => $students,
            ])

        </flux:card>


        {{-- Delete --}}
        <flux:card class="mt-6 border-red-200 dark:!bg-zinc-950 dark:border-red-950">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <flux:heading size="sm">
                        Delete Teacher
                    </flux:heading>

                    <flux:text class="mt-1 text-zinc-500">
                        Permanently remove this teacher account.
                    </flux:text>

                </div>

                <x-confirm-delete
                    name="{{ $teacher->name }}"
                    action="{{ route('admin.teachers.destroy', $teacher) }}"
                    modal="delete-teacher-{{ $teacher->id }}"
                />

            </div>

        </flux:card>

    </div>

</div>

</x-layouts::app>
