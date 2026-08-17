<x-layouts::app :title="__('Create Student')">

    <div class="space-y-8">

        {{-- Header --}}
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
                Create Student
            </flux:heading>

            <flux:text class="text-zinc-500">
                Create a new student account and assign their teachers.
            </flux:text>

        </div>


        {{-- Form --}}
        <div class="max-w-3xl">

            <flux:card class="dark:!bg-zinc-950 dark:border-zinc-800">

                @include('admin.students._form', [
                    'action' => route('admin.students.store'),
                    'method' => 'POST',
                    'submitLabel' => 'Create Student',
                    'student' => null,
                ])

            </flux:card>

        </div>

    </div>

</x-layouts::app>
