<x-layouts::app :title="$student->name">

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">
                {{ $student->name }}
            </h1>

            <p class="mt-1 text-zinc-500">
                Student Profile
            </p>

        </div>

        <a
            href="{{ route('admin.students.index') }}"
            class="rounded-lg bg-zinc-700 px-4 py-2 text-white hover:bg-zinc-800">

            Back

        </a>

    </div>



    <div class="grid gap-6 md:grid-cols-3">

        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Information
            </h2>

            <dl class="space-y-3">

                <div>
                    <dt class="text-sm text-zinc-500">Email</dt>
                    <dd class="text-zinc-900 dark:text-zinc-100">
                        {{ $student->email }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">Phone</dt>
                    <dd class="text-zinc-900 dark:text-zinc-100">
                        {{ $student->phone ?? 'Not provided' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">Status</dt>
                    <dd class="text-zinc-900 dark:text-zinc-100">
                        {{ ucfirst($student->status) }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm text-zinc-500">Join Date</dt>
                    <dd class="text-zinc-900 dark:text-zinc-100">
                        {{ optional($student->join_date)->format('M d, Y') ?? '-' }}
                    </dd>
                </div>

            </dl>

        </div>



        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Parent
            </h2>

            @if($student->parent)

                <a
                    href="{{ route('admin.parents.show', $student->parent) }}"
                    class="text-blue-600 hover:underline dark:text-blue-400">

                    {{ $student->parent->name }}

                </a>

            @else

                <span class="text-zinc-500">
                    No parent assigned
                </span>

            @endif

        </div>



        <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

            <h2 class="mb-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Teachers
            </h2>

            @forelse($student->teachers as $teacher)

                <div class="mb-2">

                    <a
                        href="{{ route('admin.teachers.show', $teacher) }}"
                        class="text-blue-600 hover:underline dark:text-blue-400">

                        {{ $teacher->name }}

                    </a>

                </div>

            @empty

                <p class="text-zinc-500">
                    No teachers assigned.
                </p>

            @endforelse

        </div>

    </div>



    <div class="rounded-xl bg-white p-6 shadow dark:bg-zinc-900">

        <h2 class="mb-4 text-xl font-semibold text-zinc-900 dark:text-white">
            Notes
        </h2>

        <p class="text-zinc-700 dark:text-zinc-300">

            {{ $student->notes ?: 'No notes available.' }}

        </p>

    </div>

</div>

</x-layouts::app>
