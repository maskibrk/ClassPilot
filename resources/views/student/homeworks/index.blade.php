<x-layouts::app :title="__('My Homework')">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                My Homework
            </h1>

            <p class="mt-2 text-zinc-500">
                View homework assigned to your classes.
            </p>

        </div>

    </div>


    @if(session('success'))

        <div class="rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>

    @endif


    <div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

        <table class="min-w-full">

            <thead class="bg-zinc-100 dark:bg-zinc-800">

                <tr>

                    <th class="px-6 py-3 text-left">
                        Title
                    </th>

                    <th class="px-6 py-3 text-left">
                        Class
                    </th>

                    <th class="px-6 py-3 text-left">
                        Due Date
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($homeworks as $homework)

                <tr class="border-t dark:border-zinc-700">

                    <td class="px-6 py-4 font-medium">

                        <a
                            href="{{ route('student.homeworks.show', $homework) }}"
                            class="text-blue-600 hover:underline dark:text-blue-400">

                            {{ $homework->title }}

                        </a>

                    </td>

                    <td class="px-6 py-4">

                        {{ $homework->academyClass->name }}

                    </td>

                    <td class="px-6 py-4">

                        {{ $homework->due_date?->format('d M Y') ?? '-' }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="3"
                        class="px-6 py-10 text-center text-zinc-500">

                        No homework assigned.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-layouts::app>
