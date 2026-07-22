<x-layouts::app :title="$class->name">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">
                {{ $class->name }}
            </h1>

            <p class="mt-2 text-zinc-500">
                {{ $class->description }}
            </p>

        </div>

        <div class="flex gap-2">

            <a
                href="{{ route('teacher.classes.edit', $class) }}"
                class="rounded-lg bg-blue-600 px-4 py-2 text-white">

                Edit

            </a>

            <form
                method="POST"
                action="{{ route('teacher.classes.destroy', $class) }}">

                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Delete this class?')"
                    class="rounded-lg bg-red-600 px-4 py-2 text-white">

                    Delete

                </button>

            </form>

        </div>

    </div>


    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <h2 class="mb-4 text-xl font-semibold">

            Students ({{ $class->students->count() }})

        </h2>

        @forelse($class->students as $student)

            <div class="border-b py-3 last:border-none dark:border-zinc-700">

                <div class="font-medium">

                    {{ $student->name }}

                </div>

                <div class="text-sm text-zinc-500">

                    {{ $student->email }}

                </div>

            </div>

        @empty

            <p class="text-zinc-500">

                No students assigned.

            </p>

        @endforelse

    </div>

</div>

</x-layouts::app>
