<x-layouts::app :title="$homework->title">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold">

                {{ $homework->title }}

            </h1>

            <p class="mt-2 text-zinc-500">

                {{ $homework->academyClass->name }}

            </p>

        </div>

        <a
            href="{{ route('teacher.homeworks.edit', $homework) }}"
            class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

            Edit

        </a>

    </div>


    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="space-y-4">

            <div>

                <h2 class="font-semibold">
                    Instructions
                </h2>

                <p class="mt-2 whitespace-pre-line">

                    {{ $homework->instructions ?: 'No instructions provided.' }}

                </p>

            </div>

            <div>

                <strong>Due Date:</strong>

                {{ $homework->due_date?->format('d M Y') ?? 'No due date' }}

            </div>

        </div>

    </div>

</div>

</x-layouts::app>
