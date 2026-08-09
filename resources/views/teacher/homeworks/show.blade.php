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

<div class="flex gap-3">

    <a
        href="{{ route('teacher.homeworks.submissions.index', $homework) }}"
        class="rounded-lg bg-green-600 px-5 py-2 text-white hover:bg-green-700">

        View Submissions

    </a>

    <a
        href="{{ route('teacher.homeworks.edit', $homework) }}"
        class="rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

        Edit Homework

    </a>

</div>
    </div>


    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <div class="space-y-8">

            <div>

                <h2 class="text-lg font-semibold">
                    Instructions
                </h2>

                <p class="mt-2 whitespace-pre-line text-zinc-700 dark:text-zinc-300">

                    {{ $homework->instructions ?: 'No instructions provided.' }}

                </p>

            </div>


            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>

                    <h3 class="font-semibold">
                        Class
                    </h3>

                    <p class="mt-1">
                        {{ $homework->academyClass->name }}
                    </p>

                </div>

                <div>

                    <h3 class="font-semibold">
                        Due Date
                    </h3>

                    <p class="mt-1">
                        {{ $homework->due_date?->format('d M Y') ?? 'No due date' }}
                    </p>

                </div>

            </div>


            <div>

                <h2 class="text-lg font-semibold">
                    Attachment
                </h2>

                @if($homework->file_path)

                    @php
                        $extension = strtolower(pathinfo($homework->file_path, PATHINFO_EXTENSION));
                    @endphp

                    @if(in_array($extension, ['png', 'jpg', 'jpeg', 'gif', 'webp']))

                        <img
                            src="{{ route('teacher.homeworks.preview', $homework) }}"
                            alt="Homework attachment"
                            class="mt-4 max-h-[700px] rounded-lg border">

                    @elseif($extension === 'pdf')

                        <iframe
                            src="{{ route('teacher.homeworks.preview', $homework) }}"
                            class="mt-4 h-[800px] w-full rounded-lg border">
                        </iframe>

                    @else

                        <div class="mt-4 rounded-lg border border-zinc-200 bg-zinc-50 p-4 dark:border-zinc-700 dark:bg-zinc-800">

                            <p class="font-medium">
                                {{ basename($homework->file_path) }}
                            </p>

                            <p class="mt-1 text-sm text-zinc-500">
                                This file type can't be previewed in the browser.
                            </p>

                            <a
                                href="{{ route('teacher.homeworks.preview', $homework) }}"
                                target="_blank"
                                class="mt-4 inline-flex rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">

                                Open Attachment

                            </a>

                        </div>

                    @endif

                @else

                    <div class="mt-4 rounded-lg border border-dashed border-zinc-300 p-6 text-center text-zinc-500 dark:border-zinc-700">

                        No attachment was uploaded for this homework.

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

</x-layouts::app>
