<x-layouts::app :title="__('Students')">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold">
                Students
            </h1>

            <p class="text-zinc-500">
                Manage all students.
            </p>
        </div>

        <a
            href="{{ route('admin.students.create') }}"
            class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700"
        >
            + Add Student
        </a>

    </div>

    @if(session('success'))
        <div class="rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Livewire handles only search + table --}}
    <livewire:admin.students.search />

</div>

</x-layouts::app>
