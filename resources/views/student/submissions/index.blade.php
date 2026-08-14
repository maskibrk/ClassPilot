<x-layouts::app :title="__('My Submissions')">

<div class="space-y-6">

{{-- Header --}}
<div>

    <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
        My Submissions
    </h1>

    <p class="mt-2 text-zinc-500">
        View the homework you have submitted.
    </p>

</div>


{{-- Submissions --}}
<div class="overflow-hidden rounded-xl bg-white shadow dark:bg-zinc-900">

    @if($submissions->isEmpty())

        <div class="p-10 text-center">

            <h2 class="text-lg font-semibold">
                No submissions yet
            </h2>

            <p class="mt-2 text-zinc-500">
                You haven't submitted any homework yet.
            </p>

            <a
                href="{{ route('student.homeworks.index') }}"
                class="mt-5 inline-flex rounded-lg bg-blue-600 px-5 py-2 text-white hover:bg-blue-700">

                View Homeworks

            </a>

        </div>

    @else

        <div class="overflow-x-auto">

            <table class="w-full text-left">

                <thead class="bg-zinc-50 dark:bg-zinc-800">

                    <tr>

                        <th class="px-6 py-4 font-semibold">
                            Homework
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Class
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Submitted
                        </th>

                        <th class="px-6 py-4 font-semibold">
                            Grade
                        </th>

                        <th class="px-6 py-4">
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($submissions as $submission)

                        <tr class="border-t border-zinc-200 dark:border-zinc-700">

                            {{-- Homework --}}
                            <td class="px-6 py-4">

                                <div class="font-medium">
                                    {{ $submission->homework->title }}
                                </div>

                                @if($submission->homework->due_date)

                                    <div class="text-sm text-zinc-500">
                                        Due {{ $submission->homework->due_date->format('d M Y') }}
                                    </div>

                                @endif

                            </td>


                            {{-- Class --}}
                            <td class="px-6 py-4">

                                {{ $submission->homework->academyClass->name }}

                            </td>


                            {{-- Submitted --}}
                            <td class="px-6 py-4">

                                @if($submission->submitted_at)

                                    <div>
                                        {{ $submission->submitted_at->format('d M Y') }}
                                    </div>

                                    <div class="text-sm text-zinc-500">
                                        {{ $submission->submitted_at->format('H:i') }}
                                    </div>

                                @else

                                    <span class="text-zinc-500">
                                        Not submitted
                                    </span>

                                @endif

                            </td>


                            {{-- Grade --}}
                            <td class="px-6 py-4">

                                @if($submission->grade !== null)

                                    <span class="font-semibold">
                                        {{ $submission->grade }}/20
                                    </span>

                                @else

                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-sm text-yellow-700">
                                        Not graded
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-6 py-4 text-right">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route('student.homeworks.show', $submission->homework) }}"
                                        class="rounded-lg bg-zinc-600 px-4 py-2 text-sm text-white hover:bg-zinc-700">

                                        Homework

                                    </a>

                                    <a
                                        href="{{ route('student.submissions.edit', $submission) }}"
                                        class="rounded-lg bg-blue-600 px-4 py-2 text-sm text-white hover:bg-blue-700">

                                        Edit Submission

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>


</div>

</x-layouts::app>
