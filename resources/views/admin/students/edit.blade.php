<x-layouts::app :title="__('Edit Student')">

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div class="space-y-2">

                <div>

                    <flux:button
                        href="{{ route('admin.students.index') }}"
                        variant="ghost"
                        size="sm"
                        icon="arrow-left"
                        inset
                    >
                        Students
                    </flux:button>

                </div>

                <flux:heading size="xl">
                    Edit Student
                </flux:heading>

                <flux:text class="text-zinc-500">
                    Update {{ $student->name }}'s information and assignments.
                </flux:text>

            </div>

            <flux:button
                href="{{ route('admin.students.show', $student) }}"
                variant="ghost"
                icon="eye"
            >
                View Student
            </flux:button>

        </div>


        {{-- Form --}}
        <div class="max-w-3xl">

            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                @include('admin.students._form', [
                    'action' => route('admin.students.update', $student),
                    'method' => 'PUT',
                    'submitLabel' => 'Save Changes',
                    'student' => $student,
                ])

            </flux:card>

{{-- Delete --}}
<div class="mt-6">

    <flux:card class="border-red-200 dark:border-red-900/50 dark:!bg-zinc-950">

        <flux:heading size="lg">
            Delete Student
        </flux:heading>

        <flux:text class="mt-1 text-zinc-500">
            Permanently remove this student account.
            This action cannot be undone.
        </flux:text>

        <div class="mt-5">

            <x-confirm-delete
                name="{{ $student->name }}"
                action="{{ route('admin.students.destroy', $student) }}"
                modal="delete-student-{{ $student->id }}"
            />

        </div>

    </flux:card>

</div>


</x-layouts::app>
