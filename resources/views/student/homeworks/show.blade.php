<x-layouts::app :title="$homework->title">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">

                {{ $homework->title }}

            </h1>

            <p class="mt-2 text-zinc-500">

                {{ $homework->academyClass->name }}

            </p>

        </div>

        <a
            href="{{ route('student.homeworks.index') }}"
            class="rounded-lg bg-zinc-600 px-5 py-2 text-white hover:bg-zinc-700">

            Back

        </a>

    </div>


    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="space-y-5">

            <div>

                <h2 class="font-semibold text-lg">
                    Instructions
                </h2>

                <p class="mt-2 whitespace-pre-line">

                    {{ $homework->instructions ?: 'No instructions provided.' }}

                </p>

            </div>

            <div class="grid gap-4 md:grid-cols-2">

                <div>

                    <strong>Class:</strong>

                    {{ $homework->academyClass->name }}

                </div>

                <div>

                    <strong>Due Date:</strong>

                    {{ $homework->due_date?->format('d M Y') ?? 'No due date' }}

                </div>

                <div>

                    <strong>Teacher:</strong>

                    {{ $homework->academyClass->teacher->name }}

                </div>

                <div>

                    <strong>Assigned:</strong>

                    {{ $homework->created_at->format('d M Y') }}

                </div>

            </div>

        </div>

    </div>

</div>

</x-layouts::app>
